<?php

namespace DSIproject\Http\Controllers;

use Carbon\Carbon;
use DB;
use DSIproject\Alumno;
use DSIproject\Departamento;
use DSIproject\Evaluacion;
use DSIproject\Grado;
use DSIproject\Http\Requests\AlumnoRequest;
use DSIproject\Materia;
use DSIproject\Municipio;
use DSIproject\Valor;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Laracasts\Flash\Flash;

class AlumnoController extends Controller
{
    /**
     * Muestra una lista de alumnos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $alumnos = Alumno::where('estado', 1)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('apellido', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nie', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('genero', 'like', '%' . $query . '%')
                ->orderBy('nombre', 'asc')
                ->paginate(25);
        }

        return view('alumnos.index')
            ->with('alumnos', $alumnos)
            ->with('searchText', $query);
    }

    /**
     * Muestra el formulario para crear un nuevo alumno.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $municipios = Municipio::orderBy('nombre', 'asc')->get();

        return view('alumnos.create')
            ->with('departamentos', $departamentos)
            ->with('municipios', $municipios);
    }

    /**
     * Almacena un alumno recién creado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\AlumnoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request)
    {        
        $alumno = new Alumno;

        // Validación de la fecha.
        $fecha = $this->crearFecha($request->fecha_nacimiento);

        if ($fecha == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        $alumno->municipio_id = $request->municipio_id;
        $alumno->nie = $request->nie;
        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->fecha_nacimiento = $fecha;
        $alumno->genero = $request->genero;
        $alumno->direccion = $request->direccion;
        $alumno->telefono = $request->telefono;
        $alumno->responsable = $request->responsable;
        $alumno->estado = 1;

        $alumno->save();

        flash('
            <h4>Registro de Alumno</h4>
            <p>El alumno <strong>' . $alumno->nombre . ' ' . $alumno->apellido . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('alumnos.index');
    }

    /**
     * Muestra el usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        return view('alumnos.show')->with('alumno', $alumno);
    }

    /**
     * Muestra el formulario para editar el alumno especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        $departamentos = Departamento::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $municipios = Municipio::orderBy('nombre', 'asc')->get();

        return view('alumnos.edit')
            ->with('alumno', $alumno)
            ->with('departamentos', $departamentos)
            ->with('municipios', $municipios);
    }

    /**
     * Actualiza el usuario especificado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\AlumnoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnoRequest $request, $id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        // Validación de la fecha.
        $fecha = $this->crearFecha($request->fecha_nacimiento);

        if ($fecha == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        $alumno->municipio_id = $request->municipio_id;
        $alumno->nie = $request->nie;
        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->fecha_nacimiento = $fecha;
        $alumno->genero = $request->genero;
        $alumno->direccion = $request->direccion;
        $alumno->telefono = $request->telefono;
        $alumno->responsable = $request->responsable;

        $alumno->save();

        flash('
            <h4>Edición de Alumno</h4>
            <p>El alumno <strong>' . $alumno->nombre . ' ' . $alumno->apellido . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('alumnos.index');
    }

    /**
     * Da de baja al usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        $alumno->estado = 0;

        $alumno->save();

        flash('
            <h4>Baja de Alumno</h4>
            <p>El alumno <strong>' . $alumno->nombre . ' ' . $alumno->apellido . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('alumnos.index');
    }

    /**
     * Da a la fecha el formato correcto para almacenarla en la base
     * de datos y verifica que sea una fecha valida.
     *
     * @param  string  $valor
     * @return string
     */
    public function crearFecha($valor)
    {
        $f = explode('/', $valor); // 0:día, 1:mes, 2:año

        $date = $f[2] . '-' . $f[1] . '-' . $f[0];

        try {
            $fecha = Carbon::parse($date)->format('Y-m-d');
            return $fecha;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Muestra el récord de notas del alumno, ya sea un resumen
     * general o específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function record($alumno_id, $grado_id)
    {
        $alumno = Alumno::find($alumno_id);                           // Información personal del alumno.

        if (! $alumno || $alumno->estado == 0) {                      // Validando que el alumno existe.
            abort(404);
        }

        $matriculas_sin_ordenar = $alumno->matriculas;                // Grados en los que se ha matriculado el alumno.
        $matriculas = $matriculas_sin_ordenar                         // Ordenando matrículas por su fecha de creación.
            ->sortBy('created_up')
            ->values()
            ->all();
        $hoy = Carbon::now()->format('d/m/y');                        // Fecha de creación del reporte.
        $valores = Valor::where('estado', 1)                          // Valores evaluados en educación moral y cívica.
            ->orderBy('valor', 'asc')
            ->get();

        if ($grado_id == 0) {                                         // Generando récord general en caso que $grado_id sea cero.

            $materias_all = Collection::make();                       // Colección de materias cursadas en cada grado.
            $promedios_all = Collection::make();                      // Colección de promedios en cada grado.
            $conducta_all = Collection::make();                       // Colección de promedios de conducta en cada grado.

            foreach ($matriculas as $matricula) {                     // Recorriendo cada grado cursado.

                $promedios = Collection::make();                      // Promedios de cada materia en el grado específico.
                $conducta = Collection::make();                       // Promedios de cada valor en el grado específico.
                $materias_sin_ordenar = $matricula                    // Materias cursadas en el grado específico.
                    ->grado
                    ->materias;
                $materias = $materias_sin_ordenar                     // Ordenando materias por su nombre.
                    ->sortBy('nombre')
                    ->values()
                    ->all();
                $materias_all->push($materias);

                foreach ($materias as $materia) {                     // Obteniendo promedios de las materias.

                    $suma = 0;                                        // Suma de los promedios obtenidos en cada trimestre.

                    for ($i = 1; $i <= 3; $i++) {                     // Obteniendo promedio de cada trimestre.
                        $suma += Materia::promediarTrimestre(
                            $matricula->grado->id,
                            $materia->id,
                            $alumno->id,
                            $i
                        );
                    }

                    $promedio = round($suma / 3.0, 2);                // Promedio final de la materia.
                    $promedios->push($promedio);
                }

                foreach ($valores as $valor) {                        // Obteniendo promedios de conducta.

                    $suma = 0;                                        // Suma de los promedios de conducta obtenidos en cada trimestre.

                    for ($i = 1; $i <= 3; $i++) {                     // Obteniendo promedio de cada trimestre.
                        $suma += Valor::promediarTrimestreConducta(
                            $matricula->grado->id,
                            $valor->id,
                            $alumno->id,
                            $i
                        );
                    }

                    $conduc = round($suma / 3.0, 2);                  // Promedio final del valor.
                    $conducta->push(
                        Valor::traducirNotaConducta($conduc)          // Traduciendo nota de conducta de un número a E, MB, B, R o M.
                    );
                }

                $promedios_all->push($promedios);
                $conducta_all->push($conducta);
            }
            
            return view('alumnos.record-general')
                ->with('alumno', $alumno)
                ->with('matriculas', $matriculas)
                ->with('hoy', $hoy)
                ->with('materias', $materias_all)
                ->with('promedios_materias', $promedios_all)
                ->with('valores', $valores)
                ->with('promedios_conducta', $conducta_all);

        } else {                                                      // Generando récord de un grado específico.

            $grado = Grado::find($grado_id);                          // Grado seleccionado.

            if (! $grado || $grado->estado == 0) {                    // Validando que el grado existe.
                abort(404);
            }

            $materias_sin_ordenar = $grado->materias;                 // Materias cursadas en el grado.
            $materias = $materias_sin_ordenar                         // Ordenando materias por su nombre.
                ->sortBy('nombre')
                ->values()
                ->all();
            $notas_evaluaciones = Collection::make();                 // Notas de todas las evaluaciones realizadas en el año.
            $notas_recuperacion = Collection::make();                 // Notas de todas las evaluaciones de recuperación realizadas en
                                                                      // el año.
            $notas_conducta = Collection::make();                     // Notas de conducta de todo el año.
            $evaluaciones = Collection::make();                       // Evaluaciones realizadas durante todo el año.
            $numero_evaluaciones = 0;                                 // Contiene el mayor número de evaluaciones realizadas en una
                                                                      // materia para determinar el número de columnas a mostrar
                                                                      // en la sección de evaluaciones de cada tabla.
            $promedios = Collection::make();                          // Promedios obtenidos en las materias durante el año.

            for ($i = 1; $i <= 3; $i++) {                             // Obteniendo datos de cada trimestre.

                $notas_trimestre = Collection::make();                // Notas de evaluaciones realizadas durante el trimestre.
                $evaluaciones_trimestre = Collection::make();         // Evaluaciones realizadas durante el trimestre.
                $recuperacion_trimestre = Collection::make();         // Evaluaciones de recuperación realizadas durante el trimestre.
                $conducta_trimestre = Collection::make();             // Notas de conducta durante el trimestre.
                $promedios_trimestre = Collection::make();            // Promedios obtenidos en las materias durante el trimestre.
                
                foreach ($materias as $materia) {                     // Obteniendo evaluaciones y notas de cada materia en el
                                                                      // trimestre.

                    $notas_materia = Collection::make();              // Notas obtenidas en la materia durante el trimestre.      
                    $evaluaciones_materia = Evaluacion::              // Evaluaciones realizadas en la materia durante el trimestre.
                          where('tipo', 'EXA')                        // Solo exámenes y actividades.
                        ->where('grado_id', $grado->id)
                        ->where('materia_id', $materia->id)
                        ->where('trimestre', $i)
                        ->orWhere('tipo', 'ACT')
                        ->where('grado_id', $grado->id)
                        ->where('materia_id', $materia->id)
                        ->where('trimestre', $i)
                        ->orderBy('posicion', 'asc')
                        ->get();

                    if ($numero_evaluaciones < count($evaluaciones_materia)) {   // Asignando nuevo número de evaluaciones.
                        $numero_evaluaciones = count($evaluaciones_materia);
                    }

                    $recuperacion_evaluacion = Evaluacion::           // Evaluación de recuperación realizada en la materia durante el
                          where('tipo', 'REC')                        // trimestre.
                        ->where('grado_id', $grado->id)
                        ->where('materia_id', $materia->id)
                        ->where('trimestre', $i)
                        ->first();

                    if ($recuperacion_evaluacion) {

                        $recuperacion_materia = DB::                  // Obteniendo nota obtenida en recuperación.
                              table('alumno_evaluacion')
                            ->where('alumno_id', $alumno->id)
                            ->where('evaluacion_id', $recuperacion_evaluacion->id)
                            ->first();

                        if ($recuperacion_materia) {
                            $recuperacion_nota = $recuperacion_materia->nota;
                        } else {
                            $recuperacion_nota = 0;                   // Si no hay nota de recuperación, asignarle el valor de cero.
                        }

                    } else {
                        $recuperacion_nota = 0;                       // Si no hay evaluación de recuperación, asignarle el valor de
                    }                                                 // cero a la nota.

                    $promedio_materia = 0;                            // Promedio obtenido en la materia.

                    foreach ($evaluaciones_materia as $evaluacion) {
                        
                        $nota = DB::table('alumno_evaluacion')        // Nota obtenida en la evaluación.
                            ->where('alumno_id', $alumno->id)
                            ->where('evaluacion_id', $evaluacion->id)
                            ->first();

                        $notas_materia->push($nota);
                        
                        if ($nota) {                                  // Sumando promedio de la materia al promedio general.
                            $promedio_materia += round($nota->nota * $evaluacion->porcentaje, 2);
                        } else {
                            $promedio_materia += 0;
                        }
                    }

                    $evaluaciones_trimestre->push($evaluaciones_materia);
                    $notas_trimestre->push($notas_materia);
                    $recuperacion_trimestre->push($recuperacion_nota);
                    $promedios_trimestre->push($promedio_materia);
                }

                foreach ($valores as $valor) {                        // Obteniendo notas de conducta.

                    $nota = DB::table('alumno_valor')                 // Nota de conducta obtenida para el valor.
                        ->where('alumno_id', $alumno->id)
                        ->where('valor_id', $valor->id)
                        ->where('trimestre', $i)
                        ->first();

                    $conducta_trimestre->push($nota);
                }

                $notas_evaluaciones->push($notas_trimestre);
                $evaluaciones->push($evaluaciones_trimestre);
                $notas_recuperacion->push($recuperacion_trimestre);
                $notas_conducta->push($conducta_trimestre);
                $promedios->push($promedios_trimestre);
            }

            return view('alumnos.record-especifico')
                ->with('alumno', $alumno)
                ->with('matriculas', $matriculas)
                ->with('hoy', $hoy)
                ->with('grado', $grado)
                ->with('materias', $materias)
                ->with('valores', $valores)
                ->with('notas_evaluaciones', $notas_evaluaciones)
                ->with('notas_recuperacion', $notas_recuperacion)
                ->with('notas_conducta', $notas_conducta)
                ->with('evaluaciones', $evaluaciones)
                ->with('numero_evaluaciones', $numero_evaluaciones)
                ->with('promedios', $promedios);
        }
    }
}
