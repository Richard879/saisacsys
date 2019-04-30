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
            if($value[3]!='' || $value[3]!=null){
                $data[$key+1] =[
                    'cNombreLinea'      => $value[0],
                    'cNombreAlmacen'    => $value[1],
                    'nNumeroReserva'    => $value[2],
                    'cNumeroVin'        => $value[3],
                    'cFormaPago'        => $value[4],
                    'cNombreMarca'      => $value[5],
                    'cNombreModelo'     => $value[6],
                    'cNombreComercial'  => $value[7],
                    'cNombreColor'      => ($value[8] == NULL) ? ($value[8] = '') : $value[8],
                    'nAnioFabricacion'  => ($value[9] == NULL) ? ($value[9] = 0) : $value[9],
                    'nAnioVersion'      => $value[10],
                    'cSimboloMoneda'    => $value[11],
                    'fTotalCompra'      => $value[12],
                    'cSerieComprobante' => ($value[13] == NULL) ? ($value[13] = '') : $value[13],
                    'cNumeroComprobante'=> ($value[14] == NULL) ? ($value[14] = '') : $value[14],
                    'dFechaFacturado'   => $value[15],
                    'cItemType'         => 'itItems'
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

        $cont = 0;
        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[0]!='' || $value[0]!=null){
                //$value[15] = ($value[15] == NULL) ? ($value[15]= 0) : $value[15];
                $data[$key+1] =[
                    'nIdVersionVeh'     => $cont,
                    'cNombreComercial'  => $value[0],
                    'nAnioFabricacion'  => $value[1],
                    'nAnioModelo'       => $value[2],
                    'cUnidadMedida'     => $value[3],
                    'cMoneda'           => $value[4],
                    'fPrecioBase'       => $value[5],
                    'fDescuento'        => $value[6],
                    'fPrecioCierre'     => $value[7],
                    'fPlaca'            => $value[8],
                    'fMargen'           => $value[9],
                    'fCostoDealer'      => $value[10],
                    'fBono'             => $value[11],
                    'fPrecioCierre2'    => $value[12],
                    'fFlete'            => $value[13],
                    'fTYP'              => $value[14],
                    'fPrecioVentaP'     => $value[15],
                    'fPrecioBonoDealer' => $value[16],
                    'fBonoEspecial'     => $value[17]
                ];
                $cont++;
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

    public function importFileProyecto(Request $request)
    {
        $file = $request->file;
        $bandera = str_random(10);
        $ruta = Storage::putFileAs('uploads/ExcelProyecto', $file, $bandera .'_'. $file->getClientOriginalName());
        return $ruta;
    }

    public function readFileProyecto(Request $request)
    {
        $nameFile = $request->nameFile;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $fxls = storage_path('app/'.$nameFile);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $data = [];
        foreach ($sheetData as $key => $value) {
            if($value[0]!='' || $value[0]!=null){
                $data[$key+1] =[
                    'cNumeroVin' => $value[0]
                ];
            }
        }

        $data = new Collection($data);
        $data = $data->values()->all();
        return response()->json($data);
    }
}
