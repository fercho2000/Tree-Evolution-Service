<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cargo;
use App\Model\empleado;
use Validate;

class cargoController extends Controller
{
    public function index()
    {
        $cargo = Cargo::all();

        return view('cargo.listar', compact('cargo'));
    }

  


    public function create()
    {
        $cargo = Cargo::all();

        return view('cargo', compact('cargo'));
    }


   
    public function store(Request $request)
    {
        $validator = [
            'nombre_cargo' => 'required|max:45|unique:cargo,nombre_cargo'
        ];

        $mensaje = [
            'unique' => 'The charge already exists, enter a different charge.',
            'required' => 'You must enter a name for the position.',
            'max'     => 'Enter a shorter name for the position.'
        ];
        $this->validate($request, $validator, $mensaje);
       
        
        $input=request()->except('_token');
        Cargo::insert($input);
        return redirect('cargo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargo = Cargo::findOrFail($id);
        return response()->json($cargo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $var = Cargo::find($id);

        return response()->json($var);
    }

    

    public function update(Request $request)
    {
        $id = $request->idcargo;
        $validator = [
            'showcargo' => 'required|max:45|unique:cargo,nombre_cargo,'. $id
        ];

        $mensaje = [
            'unique' => 'The charge already exists, enter a different charge.',
            'required' => 'You must enter a name for the position.',
            'max'     => 'Enter a shorter name for the position.'
        ];
        $this->validate($request, $validator, $mensaje);
        

        $id = $request->idcargo;
        $input = Cargo::find($id);

        $input->nombre_cargo = $request->showcargo;
        $input->save();

        return redirect('cargo');
    }



    public function destroy($id)
    {
        //
    }
}
