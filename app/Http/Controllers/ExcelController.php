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
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelCompra', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;

        /*$nameFile = $request->file->store('uploads/ExcelCompra');
        return response()->json($nameFile);*/

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
            if($value[4]!='' || $value[4]!=null){
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
                    'cNombreColor' => ($value[9] == NULL) ? ($value[9] = '') : $value[9],
                    'nAnioFabricacion' => $value[10],
                    'nAnioVersion' => $value[11],
                    'cSimboloMoneda' => $value[12],
                    'fTotalCompra' => $value[13],
                    'cSerieComprobante' => ($value[14] == NULL) ? ($value[14] = '') : $value[14],
                    'cNumeroComprobante' => ($value[15] == NULL) ? ($value[15] = '') : $value[15],
                    'dFechaFacturado' => $value[16],
                    'cItemType' => 'itItems'
                ];
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileListaPrecioVh(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelListaPrecio', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
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
            if($value[1]!='' || $value[1]!=null){
                //$value[15] = ($value[15] == NULL) ? ($value[15]= 0) : $value[15];
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
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileLeads(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelLeads', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileLeads(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            $data[$key+1] =[
                'cTipoDocumento'   => $value[0],
                'cNumeroDocumento' => $value[1],
                'cNombre' => $value[2],
                'cApellidoPaterno' => $value[3],
                'cApellidoMaterno' => $value[4],
                'cTelefonoFijo' => $value[5],
                'nTelefonoMovil' => $value[6],
                'cEmail' => $value[7],
                'cDepartamentoNombre' => $value[8],
                'cProvinciaNombre' => $value[9],
                'cDistritoNombre' => $value[10],
                'cDireccion' => $value[11],
                'cLineaNombre' => $value[12],
                'cMarcaNombre' => $value[13],
                'cModeloNombre' => $value[14],
                'nAnioFabricacion' => $value[15],
                'nAnioModelo' => $value[16],
                'cGlosa' => $value[17]
            ];
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileForum(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelForum', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileForum(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[1]!='' || $value[1]!=null){
                $data[$key+1] =[
                    'cNombreModelo' => $value[0],
                    'cNumeroVin'    => $value[1],
                    'cNumeroMotor'  => $value[2],
                    'cNombreColor'  => $value[3],
                    'cMoneda'       => $value[4],
                    'fTotalCompra'  => $value[5],
                    'dFecha'        => $value[6]
                ];
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }

    public function importFileExhibicion(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelExhibicion', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileExhibicion(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[2]!='' || $value[2]!=null){
                $data[$key+1] =[
                    'cNombreLinea' => $value[0],
                    'cNombreAlmacen' => $value[1],
                    'cNumeroVin' => $value[2],
                    'cNombreMarca' => $value[3],
                    'cNombreModelo' => $value[4],
                    'cNombreComercial' => $value[5],
                    'cNombreColor' => $value[6],
                    'nAnioFabricacion' => $value[7],
                    'nAnioModelo' => $value[8],
                    'cSimboloMoneda' => $value[9],
                    'fTotalExhibicion' => $value[10]
                ];
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }
}
