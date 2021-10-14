<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\NovedadOrden;
use App\Model\Programacion;
use App\Model\Bitacora;
use App\Model\OrdenServicio;
use Illuminate\Support\Facades\DB;

class NovedadOrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NovedadOrden = NovedadOrden::select(
            'novedadesordenesservicio.*',
            DB::raw('CONCAT(cliente.nombre," ",cliente.apellidos) as NombreCliente'),
            'tiposervicio.nombreTipoServicio'
        )
        ->join('ordenservicio', 'novedadesordenesservicio.ordenServicio_idOrdenServicio', '=', 'ordenservicio.id')
        ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
        ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
        ->get();

        return view('OrdenServicio.NovedadOrden', compact('NovedadOrden'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $IdNovedad = $request->id;

        $NovedadOrdenServicio = NovedadOrden::select(
            'novedadesordenesservicio.*',
            DB::raw('CONCAT(cliente.nombre," ",cliente.apellidos) as NombreCliente'),
            'tiposervicio.nombreTipoServicio',
            'ordenservicio.Precio',
            'ordenservicio.fechaInicio',
            'ordenservicio.fechaFin'
        )
        ->join('ordenservicio', 'novedadesordenesservicio.ordenServicio_idOrdenServicio', '=', 'ordenservicio.id')
        ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
        ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
        ->where('novedadesordenesservicio.id', '=', $IdNovedad)
        ->first();

        return (response()->json($NovedadOrdenServicio));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $IdNovedad = $request->id;

        $NovedadOrdenServicioEdit = NovedadOrden::select(
            'novedadesordenesservicio.*',
            DB::raw('CONCAT(cliente.nombre," ",cliente.apellidos) as NombreCliente'),
            'tiposervicio.nombreTipoServicio',
            'ordenservicio.Precio',
            'ordenservicio.fechaInicio',
            'ordenservicio.fechaFin'
        )
        ->join('ordenservicio', 'novedadesordenesservicio.ordenServicio_idOrdenServicio', '=', 'ordenservicio.id')
        ->join('cliente', 'ordenservicio.Cliente_idCliente', '=', 'cliente.id')
        ->join('tiposervicio', 'ordenservicio.tipoServicio_idTipoServicio', '=', 'tiposervicio.id')
        ->where('novedadesordenesservicio.id', '=', $IdNovedad)
        ->first();

        return (response()->json($NovedadOrdenServicioEdit));
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
        //
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
