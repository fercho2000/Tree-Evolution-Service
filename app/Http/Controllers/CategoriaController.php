<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use App\Model\Categoria;
use Validator;
use Response;
use View;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categoria = Categoria::all();
        return view('Categoria.categoria', compact('Categoria'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nombre_categoria' => 'required|unique:categoria'
    );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    
                'errors' => $validator->getMessageBag()->toArray()
        ));
        } else {
            $Categoria = new Categoria();
            $Categoria->nombre_categoria = $request->nombre_categoria;
            $Categoria->save();
            return response()->json($Categoria);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id= $request->id;
        $Categoria = Categoria::find($id);


        return (response()->json($Categoria));
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
        $Categoria = Categoria::find($id);

        return (response()->json($Categoria));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request-> id;
        $Categoria = Categoria::find($id);
        $Categoria->nombre_categoria=$request->nomb_categoria;
        $Categoria->save();
        return redirect() -> back() -> with('success', 'Ha Sido Actualizo');
    }
 
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Categoria = Categoria::findOrFail($id);
        $Categoria->delete();

        return response()->json($Categoria);
    }
}
