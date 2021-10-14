<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\KithasImplemento;
use Response;

class Kit_Has_Implemento extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $implementosKit = KithasImplemento::select(
            'implementostrabajo_has_kit.*',
            'implemento.codigo_implemento',
            'implemento.nombre_implemento',
            'implemento.imagen'
        )
        ->join('implemento', 'implementostrabajo_has_kit.implemento_id', '=', 'implemento.id')
        ->where('implementostrabajo_has_kit.kit_id', $id)
        ->get();

        return (response()->json($implementosKit));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->kit_id;
        $implemento = $request->implemento_id;
        $DeleteIm = DB::table('implementostrabajo_has_kit')->where('kit_id', '=', $id)
        ->where('implemento_id', '=', $implemento)->delete();

        return (response()->json([
            'Confirm' => 'The implement has been permanently removed'
         ]));
    }
}
