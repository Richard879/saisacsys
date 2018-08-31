<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Compra;
use App\ListaPrecioVersionVeh;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExcelController extends Controller
{

    public function importFileCompra(Request $request)
    {        
        //$textFile = $request->file->getClientOriginalName();
        $nameFile = $request->file->store('uploads/ExcelCompra');
        return response()->json($nameFile);
        /*return response()->json([
            'nombreFile' => $nameFile,
            'textoFile' => $textFile
        ]);*/
    }
    
    public function readFileCompra(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            $data[$key+1] =[
                'nOrdenCompra'   => $value[0],
                'cNombreLinea' => $value[1],
                'cNombreAlmacen' => $value[2],
                'nNumeroReserva' => $value[3],
                'cNumeroVin' => $value[4],
                'cFormaPago' => $value[5],
                'cNombreMarca' => $value[6],
                'cNombreModelo' => $value[7],
                'cNombreComercial' => $value[8],
                'cNombreColor' => $value[9],
                'nAnioFabricacion' => $value[10],
                'nAnioVersion' => $value[11],
                'cSimboloMoneda' => $value[12],
                'fTotalCompra' => $value[13],
                'cNumeroFactura' => $value[14],
                'dFechaFacturado' => $value[15]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileListaPrecioVh(Request $request)
    {
        $nameFile = $request->file->store('uploads/ExcelListaPrecio');
        return response()->json($nameFile);
    }
    
    public function readFileListaPrecioVh(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            $data[$key+1] =[
                'nIdVersionVeh'   => $value[0],
                'cNombreComercial' => $value[1],
                'nAnioFabricacion' => $value[2],
                'nAnioModelo' => $value[3],
                'cUnidadMedida' => $value[4],
                'cMoneda' => $value[5],
                'fPrecioBase' => $value[6],
                'fDescuento' => $value[7],
                'fPrecioCierre' => $value[8],
                'fPlaca' => $value[9],
                'fMargen' => $value[10],
                'fCostoDealer' => $value[11],
                'fBono' => $value[12],
                'fPrecioCierre2' => $value[13],
                'fFlete' => $value[14],
                'fTYP' => $value[15],
                'fPrecioVentaP' => $value[16],
                'fPrecioBonoDealer' => $value[17],
                'fBonoEspecial' => $value[18]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }
    
}