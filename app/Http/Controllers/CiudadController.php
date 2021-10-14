<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Ciudad;
use Illuminate\Support\Facades\View;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudad = Ciudad::all();

        return View('empleado.ciudad', compact('ciudad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudad = Ciudad::all();

        return View('empleado.ciudad', compact('ciudad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = ['nombreCiudad' => 'required|unique:ciudad,nombreCiudad|max:45', ];

        $mensajes = [
            'required' => 'Enter a name for the city',
            'unique' => 'The city you are trying to register already exists.',
            'max'   => 'The name of the city is very long',
        ];

        $this->validate($request, $campos, $mensajes);

        $input = request()->except('_token');
        if (Ciudad::insert($input)) {
            return redirect('ciudad');
        } else {
            return redirect('ciudad')->with('Mensaje', 'Sorry, we can not register the city.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ciudad = Ciudad::find($id);
        return response()->json($ciudad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        $id = $request->id;
      
        $cons = Ciudad::find($id);
        
        return (response()->json($cons));
    }

  
    public function update(Request $request)
    {
        $id = $request->idciudad;

        $campos = ['showciudad' => 'required|max:45|unique:ciudad,nombreCiudad,' . $id ];
        
        $mensajes = [
            'required' => 'Enter a name for the city',
            'unique' => 'The city you are trying to register already exists.',
            'max'   => 'The name of the city is very long',
        ];

        $this->validate($request, $campos, $mensajes);

        $id = $request->idciudad;
        $input = Ciudad::find($id);
        $input->nombreCiudad = $request->showciudad;
        $input->save();
        
        
        return redirect('ciudad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
