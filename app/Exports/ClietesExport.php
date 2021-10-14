<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Model\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClietesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Full name', 'Identification number', 'Address',
            'Contact number',
            'Email',
            'City','Gender','Number of service orders performed'
        ];
    }


    
    public function collection()
    {
        // $Consultaexcel = Cliente::select('nombre','apellidos','direccion','NumeroDeContacto',
        // 'CorreoElectronico','ciudad.nombreCiudad')
        // ->join('ciudad','cliente.ciudad_idCiudad','=','ciudad.id')->get();
        $Consultaexcel= Cliente::select(
            DB::raw('CONCAT(cliente.nombre," ", cliente.apellidos) as "Nombre Completo" '),
            "cliente.NumeroDeIdentificacion as 'Numero de identificacion' ",
            'cliente.direccion as Direccion ',
            "cliente.NumeroDeContacto as 'Numero de contacto' ",
            'cliente.CorreoElectronico as Correo',
            'ciudad.nombreCiudad as Ciudad',
            'genero.NombreGenero as Genero',
            DB::raw("COUNT(ordenservicio.Cliente_idCliente) as 'Numero de ordenes'")
        )
       ->leftJoin('ordenservicio', function ($join) {
           $join->on('cliente.id', '=', 'ordenservicio.Cliente_idCliente')
           ->where('ordenservicio.estados_idEstado', '=', '4');
       })
       ->join('ciudad', 'cliente.ciudad_idCiudad', '=', 'ciudad.id')
       ->join('genero', 'cliente.Genero_idGenero', '=', 'genero.id')
       ->groupBy('cliente.id')
       ->orderBy('cliente.nombre', 'desc')
       ->get();
        return ($Consultaexcel);
    }
}
