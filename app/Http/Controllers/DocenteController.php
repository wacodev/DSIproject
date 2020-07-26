<?php

namespace DSIproject\Http\Controllers;

use Carbon\Carbon;
use DSIproject\Docente;
use DSIproject\Jornadas;
use DSIproject\Grados;
use DSIproject\Http\Requests\DocenteRequest;
use DSIproject\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Laracasts\Flash\Flash;
use Barryvdh\DomPDF\Facade as PDF;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $docentes = Docente::where('estado', 1)
                ->where('user_id', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nip', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('docente.index')
            ->with('docentes', $docentes)
            ->with('searchText', $query);
        //$docentes = Docente::orderBy('id','ASC')->paginate(25);
        //return view('docente.index')->with('docentes', $docentes);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Solo usuarios que no han sido registrados como docentes antes.
        $users = User::where('estado', 1)->orderBy('nombre', 'asc')->get();

        if (count($users) > 0) {
            foreach ($users as $key => $user) {
                //dd($users, $key, $user);
                $docente = Docente::where('user_id', $user->id)
                    ->where('estado', 1)
                    ->first();
                if ($docente) {
                    $users->pull($key);
                }
            }
        }

        $users = $users->pluck('nombre_and_apellido', 'id');
        
        return view('docente.create')->with('users', $users);
    }

    /**
     * Almacena un docente en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocenteRequest $request)
    {
        // Validación de la fecha.
        $fecha = $this->crearFecha($request->fecha_nacimiento);

        if ($fecha == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        // Almacenamiento de la imagen.
        if ($request->file('imagen')) {
            $file = $request->file('imagen');

            $nombre = 'docente_' . time() . '.' . $file->getClientOriginalExtension();

            $path = public_path() . '/img/docentes/';

            $file->move($path, $nombre);
        } else {
            $nombre = "docente_default.jpg";
        }

        $docente = new Docente($request->all());
        $docente->fecha_nacimiento = $fecha;
        $docente->imagen = $nombre;
        $docente->estado = 1;

        $docente->save();

        flash('
            <h4>Registro de Docente</h4>
            <p>El docente <strong>' . $docente->nombre . ' ' . $docente->apellido . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('docentes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $docente = Docente::find($id);

        if (! $docente || $docente->estado == 0) {
            abort(404);
        }

        return view('docente.show')->with('docente', $docente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $docente = Docente::find($id);

        if (!$docente || $docente->estado == 0) {
            abort(404);
        }

        $users = User::orderBy('nombre', 'asc')->get()->pluck('nombre_and_apellido', 'id');

        return view('docente.edit')
            ->with('docente', $docente)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocenteRequest $request, $id)
    {
         $docente = Docente::find($id);

        if (!$docente || $docente->estado == 0) {
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

        // Almacenamiento de la imagen.
        if ($request->file('imagen')) {
            $file = $request->file('imagen');

            $nombre = 'docente_' . time() . '.' . $file->getClientOriginalExtension();

            $path = public_path() . '/img/docentes/';

            $file->move($path, $nombre);

            // Eliminación de la imagen anterior.
            if (\File::exists($path . $docente->imagen) && $docente->imagen != 'docente_default.jpg') {
                \File::delete($path . $docente->imagen);
            }
        } else {
            $nombre = $docente->imagen;
        }
        
        $docente->fill($request->all());
        $docente->fecha_nacimiento = $fecha;
        $docente->imagen = $nombre;
        
        $docente->save();

        flash('
            <h4>Edición de Docente</h4>
            <p>El docente <strong>' . $docente->nombre . ' ' . $docente->apellido . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('docentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $docente = Docente::find($id);

        if (!$docente || $docente->estado == 0) {
            abort(404);
        }

        $docente->estado = 0;

        $docente->save();

        flash('
            <h4>Baja de Docente</h4>
            <p>El docente <strong>' . $docente->nombre . ' ' . $docente->apellido . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('docentes.index');
    }

    public function pdf(Request $request)
    {        
        if ($request) {
            $query = trim($request->get('searchText'));

            $docentes = Docente::where('estado', 1)
                ->where('user_id', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nip', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('docente.pdf')
            ->with('docentes', $docentes)
            ->with('searchText', $query);
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
}
