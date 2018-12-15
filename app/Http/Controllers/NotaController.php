<?php

namespace DSIproject\Http\Controllers;

use Carbon\Carbon;
use DB;
use DSIproject\Anio;
use DSIproject\Docente;
use DSIproject\Evaluacion;
use DSIproject\Grado;
use DSIproject\Materia;
use DSIproject\Valor;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;

class NotaController extends Controller
{
    /**
     * Muestra una lista de grados y materias impartidas en el año.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obteniendo año del cual se tomaran los registros.
        $anio = Anio::where('activo', 1)->first();

        if ($request->anio_search) {
            $anio = Anio::find($request->anio_search);
        }

        // Para select que contiene los años.
        $anios = Anio::where('estado', 1)
            ->orderBy('numero', 'asc')
            ->pluck('numero', 'id');

        /*
         * Obteniendo grados donde se es orientador y materias que se imparten.
         * Los usuarios con rol de director o secretaria pueden ver todos los registros.
         */
        $materias = Collection::make();

        if (\Auth::user()->docen()) {

            $docente = Docente::where('user_id', \Auth::user()->id)->first();
            
            $grados = Grado::where('estado', 1)
                ->where('anio_id', $anio->id)
                ->where('docente_id', $docente->id)
                ->orderBy('codigo', 'asc')
                ->get();

            if (count($grados) > 0) {

                foreach ($grados as $grado) {

                    $m = DB::table('materias')
                        ->join('grado_materia', 'materias.id', 'grado_materia.materia_id')
                        ->join('grados', 'grado_materia.grado_id', 'grados.id')
                        ->select('materias.*', 'grados.codigo as grado', 'grado_materia.id as gra_mat')
                        ->where('grado_materia.grado_id', $grado->id)
                        ->where('grado_materia.docente_id', $docente->id)
                        ->orderBy('nombre', 'asc')
                        ->get();

                    if (count($m) > 0) {
                        $materias->push($m);
                    }
                }
            }
        } else {

            $grados = Grado::where('estado', 1)
                ->where('anio_id', $anio->id)
                ->orderBy('codigo', 'asc')
                ->get();

            if (count($grados) > 0) {

                foreach ($grados as $grado) {

                    $m = DB::table('materias')
                        ->join('grado_materia', 'materias.id', 'grado_materia.materia_id')
                        ->join('grados', 'grado_materia.grado_id', 'grados.id')
                        ->select('materias.*', 'grados.codigo as grado', 'grado_materia.id as gra_mat')
                        ->where('grado_materia.grado_id', $grado->id)
                        ->orderBy('nombre', 'asc')
                        ->get();

                    if (count($m) > 0) {
                        $materias->push($m);
                    }
                }
            }
        }

        return view('notas.index')
            ->with('anio', $anio)
            ->with('anios', $anios)
            ->with('grados', $grados)
            ->with('materias', $materias);
    }

    /**
     * Muestra el cuadro de notas para edición.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $gra_mat = DB::table('grado_materia')
            ->select('grado_id', 'materia_id')
            ->where('id', $id)
            ->first();

        if (!$gra_mat) {
            abort(404);
        }

        $grado = Grado::find($gra_mat->grado_id);

        $materia = Materia::find($gra_mat->materia_id);

        // Si campo trimestre es nulo.
        if (!$request->trimestre) {
            $request->trimestre = 1;
        }

        $evaluaciones = Evaluacion::where('tipo', 'EXA')
            ->where('grado_id', $grado->id)
            ->where('materia_id', $materia->id)
            ->where('trimestre', $request->trimestre)
            ->orWhere('tipo', 'ACT')
            ->where('grado_id', $grado->id)
            ->where('materia_id', $materia->id)
            ->where('trimestre', $request->trimestre)
            ->orderBy('posicion', 'asc')
            ->get();

        $matriculas_sin_orden = $grado->matriculas;
        $matriculas = $matriculas_sin_orden->sortBy('apellido')->values()->all();

        // Verificar si existe evaluación de recuperación.
        $num_rec = Evaluacion::where('materia_id', $materia->id)
            ->where('grado_id', $grado->id)
            ->where('tipo', 'REC')
            ->where('trimestre', $request->trimestre)
            ->count();

        if ($num_rec == 0) {
            $recuperacion = new Evaluacion;
            $recuperacion->grado_id = $grado->id;
            $recuperacion->materia_id = $materia->id;
            $recuperacion->tipo = 'REC';
            $recuperacion->porcentaje = 1;
            $recuperacion->trimestre = $request->trimestre;
            $recuperacion->posicion = 0;
            $recuperacion->save();
        }

        // Evaluación de recuperación del ciclo.
        $rec = Evaluacion::where('materia_id', $materia->id)
            ->where('grado_id', $grado->id)
            ->where('tipo', 'REC')
            ->where('trimestre', $request->trimestre)
            ->first();

        // Arreglos con las notas.
        $notas = Collection::make();
        $promedios = Collection::make();
        $recuperaciones = Collection::make();
        $finales = Collection::make();

        foreach ($matriculas as $matricula) {

            $nota = Collection::make();
            $promedio = 0;

            foreach ($evaluaciones as $evaluacion) {
                $n = DB::table('alumno_evaluacion')
                    ->where('alumno_id', $matricula->alumno->id)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->first();

                // Si no hay registro.
                if (! $n) {
                    $evaluacion->alumnos()->attach($matricula->alumno->id, ['nota' => 0]);

                    $n = DB::table('alumno_evaluacion')
                        ->where('alumno_id', $matricula->alumno->id)
                        ->where('evaluacion_id', $evaluacion->id)
                        ->first();
                }

                $promedio += round($n->nota * $evaluacion->porcentaje, 2);

                $nota->push($n);
            }

            // Notas.
            $notas->push($nota);

            // Promedio.
            //$promedio = round($nota->avg('nota'), 2);
            $promedios->push($promedio);

            // Recuperacion.
            $r = DB::table('alumno_evaluacion')
                ->where('alumno_id', $matricula->alumno->id)
                ->where('evaluacion_id', $rec->id)
                ->first();

            // Si no hay registro.
            if (! $r) {
                $rec->alumnos()->attach($matricula->alumno->id, ['nota' => 0]);

                $r = DB::table('alumno_evaluacion')
                    ->where('alumno_id', $matricula->alumno->id)
                    ->where('evaluacion_id', $rec->id)
                    ->first();
            }

            $recuperaciones->push($r);

            // Finales.
            $final = $promedio + $r->nota;
            $finales->push($final);
        }

        return view('notas.edit')
            ->with('grado', $grado)
            ->with('materia', $materia)
            ->with('gra_mat', $id)
            ->with('trimestre', $request->trimestre)
            ->with('evaluaciones', $evaluaciones)
            ->with('matriculas', $matriculas)
            ->with('notas', $notas)
            ->with('promedios', $promedios)
            ->with('recuperaciones', $recuperaciones)
            ->with('finales', $finales);
    }

    /**
     * Actualiza las notas especificadas en la base de datos.
     *
     * @param  \DSIproject\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Notas de evaluaciones de tipo examen y actividad.
        $notas_v = $request->notas_v;

        $notas_id = $request->notas_id;

        for ($i = 0; $i < count($notas_v); $i++) {

            if (empty($notas_v[$i])) {
                flash('
                    <h4>Error en Ingreso de Datos</h4>
                    <p>No dejar campos vacíos.</p>
                ')->error()->important();

                return back();
            }

            if(! is_numeric($notas_v[$i])) {
                flash('
                    <h4>Error en Ingreso de Datos</h4>
                    <p>Solo ingresar valores numéricos.</p>
                ')->error()->important();

                return back();
            }

            if($notas_v[$i] < 0 || $notas_v[$i] > 10) {
                flash('
                    <h4>Error en Ingreso de Datos</h4>
                    <p>La nota debe estar entre 0 y 10.</p>
                ')->error()->important();

                return back();
            }

            $nota = DB::table('alumno_evaluacion')
                ->where('id', $notas_id[$i])
                ->first();

            $evaluacion = Evaluacion::find($nota->evaluacion_id);

            $evaluacion->alumnos()->updateExistingPivot($nota->alumno_id, ['nota' => $notas_v[$i]]);
        }

        // Notas de recuperación.
        $recuperaciones_v = $request->recuperaciones_v;

        $recuperaciones_id = $request->recuperaciones_id;

        for ($i = 0; $i < count($recuperaciones_v); $i++) { 
            
            $nota = DB::table('alumno_evaluacion')
                ->where('id', $recuperaciones_id[$i])
                ->first();

            $evaluacion = Evaluacion::find($nota->evaluacion_id);

            $evaluacion->alumnos()->updateExistingPivot($nota->alumno_id, ['nota' => $recuperaciones_v[$i]]);
        }

        flash('
            <h4>Actualización de Notas</h4>
            <p>Las notas se han actualizado correctamente.</p>
        ')->success()->important();

        return redirect()->back();
    }

    /**
     * Muestra el cuadro de notas de conducta para edición.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editConducta(Request $request, $id)
    {
        $grado = Grado::where('id', $id)->first();

        if (!$grado) {
            abort(404);
        }

        // Si campo trimestre es nulo.
        if (!$request->trimestre) {
            $request->trimestre = 1;
        }

        $valores = Valor::where('estado', 1)->get();

        $matriculas_sin_orden = $grado->matriculas;
        $matriculas = $matriculas_sin_orden->sortBy('apellido')->values()->all();

        // Arreglos con las notas de conducta.
        $notas = Collection::make();

        foreach ($matriculas as $matricula) {

            $nota = Collection::make();

            foreach ($valores as $valor) {
                $n = DB::table('alumno_valor')
                    ->where('alumno_id', $matricula->alumno->id)
                    ->where('valor_id', $valor->id)
                    ->where('grado_id', $grado->id)
                    ->where('trimestre', $request->trimestre)
                    ->first();

                // Si no hay registro.
                if (! $n) {
                    $valor->alumnos()->attach($matricula->alumno->id, ['nota' => null, 'grado_id' => $grado->id, 'trimestre' => $request->trimestre]);

                    $n = DB::table('alumno_valor')
                        ->where('alumno_id', $matricula->alumno->id)
                        ->where('valor_id', $valor->id)
                        ->where('grado_id', $grado->id)
                        ->where('trimestre', $request->trimestre)
                        ->first();
                }

                $nota->push($n);
            }

            // Notas.
            $notas->push($nota);
        }

        return view('conducta.edit')
            ->with('grado', $grado)
            ->with('trimestre', $request->trimestre)
            ->with('valores', $valores)
            ->with('matriculas', $matriculas)
            ->with('notas', $notas);
    }

    /**
     * Actualiza las notas de conducta especificadas en la base de datos.
     *
     * @param  \DSIproject\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateConducta(Request $request)
    {
        // Notas de evaluaciones de tipo examen y actividad.
        $notas_v = $request->notas_v;

        $notas_id = $request->notas_id;

        for ($i = 0; $i < count($notas_v); $i++) {
            $nota = DB::table('alumno_valor')
                ->where('id', $notas_id[$i])
                ->update(['nota' => $notas_v[$i]]);
        }

        flash('
            <h4>Actualización de Notas</h4>
            <p>Las notas se han actualizado correctamente.</p>
        ')->success()->important();

        return redirect()->back();
    }

    /**
     * Muestra el formulario para crear un reporte de notas.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createReporte($id)
    {
        $grado = Grado::find($id);

        if (!$grado) {
            abort(404);
        }

        return view('notas.create-reporte')->with('grado', $grado);
    }

    /**
     * Genera un reporte de notas para descargar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadReporte(Request $request)
    {
        // Validando datos de entrada.
        $request_data = array(
            'grado_id'  => 'required',
            'tipo'      => 'required',
        );

        if ($request->tipo == 'T') {
            $request_data['trimestre'] = 'required';
        }

        $this->validate(request(), $request_data);
        
        // Fecha de creación.
        $hoy = Carbon::now()->format('d/m/y');

        // Grado.
        $grado = Grado::find($request->grado_id);

        // Materias.
        $materias_sin_ordenar = $grado->materias;
        $materias = $materias_sin_ordenar->sortBy('nombre')->values()->all();

        // Alumnos matriculados en el grado.
        $matriculas_sin_orden = $grado->matriculas;
        $matriculas = $matriculas_sin_orden->sortBy('apellido')->values()->all();

        // Notas de evaluaciones en todas las materias y de todos los alumnos.
        $notas_all = Collection::make();

        foreach ($materias as $materia) {

            // Notas de todos los alumnos en la materia especificada.
            $notas = Collection::make();

            foreach ($matriculas as $matricula) {

                // Para promedio trimestral.
                if ($request->tipo == 'T') {
                    $promedio = $this->promediarTrimestre($grado->id, $materia->id, $matricula->alumno->id, $request->trimestre);
                
                // Para promedio anual.
                } else {
                    $prom = 0;
                    for ($i = 1; $i <= 3; $i++) {
                        $prom += $this->promediarTrimestre($grado->id, $materia->id, $matricula->alumno->id, $i);
                    }
                    $promedio = round($prom / 3.0, 2);
                }

                $notas->push($promedio);
            }

            $notas_all->push($notas);
        }

        // Valores.
        $valores = Valor::where('estado', 1)->get();

        return view('notas.reporte')
            ->with('grado', $grado)
            ->with('hoy', $hoy)
            ->with('materias', $materias)
            ->with('matriculas', $matriculas)
            ->with('notas', $notas_all)
            ->with('valores', $valores);
    }

    // LOS PROMEDIOS
    public function promediarTrimestre($grado, $materia, $alumno, $trimestre)
    {
        // Evaluaciones del trimestre.
        $evaluaciones = Evaluacion::where('tipo', 'EXA')
            ->where('grado_id', $grado)
            ->where('materia_id', $materia)
            ->where('trimestre', $trimestre)
            ->orWhere('tipo', 'ACT')
            ->where('grado_id', $grado)
            ->where('materia_id', $materia)
            ->where('trimestre', $trimestre)
            ->get();

        // Promedio del trimestre.
        $promedio = 0;

        // Si hay evaluaciones.
        if (count($evaluaciones) > 0) {
            foreach ($evaluaciones as $evaluacion) {
                $nota = DB::table('alumno_evaluacion')
                    ->where('alumno_id', $alumno)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->first();

                // Si hay registro.
                if ($nota) {
                    $promedio += round($nota->nota * $evaluacion->porcentaje, 2);
                } else {
                    $promedio += 0;
                }
            }
        }

        // Evaluación de recuperación.
        $recuperacion = Evaluacion::where('tipo', 'REC')
            ->where('grado_id', $grado)
            ->where('materia_id', $materia)
            ->where('trimestre', $trimestre)
            ->first();

        // Si hay evaluación de recuperación.
        if ($recuperacion) {
            $nota_recuperacion = DB::table('alumno_evaluacion')
                ->where('alumno_id', $alumno)
                ->where('evaluacion_id', $recuperacion->id)
                ->first();

            if ($nota_recuperacion) {
                $promedio += round($nota_recuperacion->nota, 2);
            }
        } else {
            $promedio += 0;
        }

        return $promedio;
    }
}
