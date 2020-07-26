<?php

namespace DSIproject\Http\Controllers;

use Carbon\Carbon;
use DB;
use DSIproject\Inventario;
use DSIproject\Recurso;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class InventarioController extends Controller
{
    /**
     * Muestra una lista de inventarios.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = $request->get('searchFecha');

            if ($query != "dd/mm/yyyy" && $query != null) {
            	$fecha = $this->crearFecha($query);                   // Validando que la fecha ingresada sea correcta y convirtiendo
                                                                      // al formato Y-m-d.
            	if ($fecha == null) {                                 // Mensaje de error si la fecha es inválida.
            		flash('
	                <h4>Error en Ingreso de Datos</h4>
	                <p>El formato de la fecha es incorrecto.</p>
	            ')->error()->important();

	            return back();
            	}

            } else {
                $fecha = "";                                          // Dejar fecha vacía si la ingresada es inválida.
            }

            $inventarios = Inventario::where('estado', 1)             // Inventarios que están de alta y ordenados de forma descendente
                ->where('fecha', 'like', '%' . $fecha . '%')          // por su fecha.
                ->orderBy('fecha', 'desc')
                ->paginate(25);
        }

        return view('inventarios.index')
            ->with('inventarios', $inventarios)
            ->with('searchFecha', $query);
    }

    /**
     * Muestra el formulario para crear un nuevo inventario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventarios.create');
    }

    /**
     * Almacena un inventario recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate(request(), [                                  // Validación del formulario.
            'fecha' => 'required',
        ]);

        $inventario = new Inventario;

        $fecha = $this->crearFecha($request->fecha);                  // Validando que la fecha ingresada sea correcta

        if ($fecha == null) {                                         // Mensaje de error si la fecha es inválida.
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        $inventario->fecha = $fecha;
        $inventario->estado = 1;                                      // Indicando que el inventario está de alta.

        $inventario->save();

        flash('
            <h4>Registro de Inventario</h4>
            <p>El inventario se ha registrado correctamente.</p>
        ')->success()->important();                                   // Mensaje de éxito en la operación.

        return redirect()->route('inventarios.index');
    }

    /**
     * Agrega un recurso al inventario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request, $id)
    {
        $this->validate(request(), [                                  // Validación del formulario.
            'recurso_id' => 'required',
            'cantidad'   => 'required|numeric',
        ]);

        $inventario = Inventario::find($id);

        if (! $inventario || $inventario->estado == 0) {              // Comprobando que el inventario exista y esté de alta.
            abort(404);
        }

        $recurso_validar = DB::table('inventario_recurso')            // Validando que el recurso no haya sido agregado al inventario
            ->where('inventario_id', $inventario->id)                 // antes.
            ->where('recurso_id', $request->recurso_id)
            ->first();

        if ($recurso_validar != null) {                               // Mensaje de error si el recurso ya está agregado.
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>Ya ha sido agregado este recurso al inventario.</p>
            ')->error()->important();

            return back();
        }

        $inventario                                                   // Agregando recurso al inventario con su respectiva cantidad.
        	->recursos()
        	->attach($request->recurso_id, ['cantidad' => $request->cantidad]);

        flash('
            <h4>Registro de Recurso en el Inventario</h4>
            <p>El recurso se ha registrado correctamente en el inventario.</p>
        ')->success()->important();                                   // Mensaje de éxito en la operación.

        return redirect()->back();
    }

    /**
     * Muestra una lista de recursos incluidos en el inventario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $inventario = Inventario::find($id);

        if (! $inventario || $inventario->estado == 0) {              // Comprobando que el inventario exista y esté de alta.
            abort(404);
        }

        $recursos = Recurso::orderBy('nombre', 'asc')                 // Recursos para llenar select del formulario.
        	->pluck('nombre', 'id');

        if ($request) {
            $query = trim($request->get('searchText'));

            $recursos_inventario = DB::                               // Recursos incluidos en el inventario.
                  table('inventario_recurso as ir')
                ->join('inventarios as i', 'ir.inventario_id', 'i.id')
                ->join('recursos as r', 'ir.recurso_id', 'r.id')
                ->select('ir.*', 'r.nombre')
                ->where('ir.inventario_id', $inventario->id)
                ->where('r.nombre', 'like', '%' . $query . '%')
                ->orderBy('r.nombre', 'asc')
                ->paginate(25);
        }

        return view('inventarios.show')
            ->with('inventario', $inventario)
            ->with('recursos', $recursos)
            ->with('recursos_inventario', $recursos_inventario)
            ->with('searchText', $query);
    }

    /**
     * Muestra el formulario para editar el inventario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventario = Inventario::find($id);

        if (! $inventario || $inventario->estado == 0) {              // Comprobando que el inventario exista y esté de alta.
            abort(404);
        }

        return view('inventarios.edit')
        	->with('inventario', $inventario);
    }

    /**
     * Actualiza el inventario especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventario = Inventario::find($id);

        if (! $inventario || $inventario->estado == 0) {              // Comprobando que el inventario exista y esté de alta.
            abort(404);
        }

        $fecha = $this->crearFecha($request->fecha);                  // Validando que la fecha ingresada sea correcta

        if ($fecha == null) {                                         // Mensaje de error si la fecha es inválida.
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        $inventario->fecha = $fecha;

        $inventario->save();

        flash('
            <h4>Edición de Inventario</h4>
            <p>El inventario se ha editado correctamente.</p>
        ')->success()->important();                                   // Mensaje de éxito en la operación.

        return redirect()->route('inventarios.index');
    }

    /**
     * Da de baja al inventario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventario = Inventario::find($id);

        if (! $inventario || $inventario->estado == 0) {              // Comprobando que el inventario exista y esté de alta.
            abort(404);
        }

        $inventario->estado = 0;                                      // Dando de baja al inventario.

        $inventario->save();

        flash('
            <h4>Baja de Inventario</h4>
            <p>El inventario se ha dado de baja correctamente.</p>
        ')->error()->important();                                     // Mensaje de éxito en la operación.

        return redirect()->route('inventarios.index');
    }

    /**
     * Elimina el recurso especificado del inventario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy2($id)
    {
        $inventario_recurso = DB::table('inventario_recurso')->find($id);

        if (! $inventario_recurso) {                                  // Comprobando que el recurso está agregado en el inventario.
            abort(404);
        }

        DB::table('inventario_recurso')->delete($id);

        flash('
            <h4>Eliminación de Recurso del Inventario</h4>
            <p>El recurso se ha eliminado del inventario correctamente.</p>
        ')->error()->important();                                     // Mensaje de éxito en la operación.

        return back();
    }

    /**
     * Da a la fecha el formato correcto para almacenarla en la base de datos y
     * verifica que sea una fecha válida.
     *
     * @param  string  $valor
     * @return string
     */
    public function crearFecha($valor)
    {
        $f = explode('/', $valor);                                    // Separando los elementos que componen la fecha.

        $date = $f[2] . '-' . $f[1] . '-' . $f[0];                    // 0 -> día, 1 -> mes, 2 -> año

        try {
            $fecha = Carbon::parse($date)->format('Y-m-d');           // Convirtiendo fecha al formato Y-m-d.
            return $fecha;
        } catch (\Exception $e) {
            return null;                                              // Envía null si la fecha ingresada es incorrecta.
        }
    }
}
