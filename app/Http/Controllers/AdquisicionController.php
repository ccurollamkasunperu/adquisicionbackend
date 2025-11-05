<?php
namespace App\Http\Controllers;

header('Content-Type: application/json; charset=utf-8');
mb_internal_encoding("UTF-8");

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Normalizer;
use Illuminate\Support\Facades\File;


class AdquisicionController extends Controller
{   
    public function estadoordensel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_eso_id' => 'required|integer',
                'p_eso_activo' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_eso_id = $request->has('p_eso_id') ? (int) $request->input('p_eso_id') : 0;
                $p_eso_activo = $request->has('p_eso_activo') ? (int) $request->input('p_eso_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_estadoorden_sel(?,?)", [
                    $p_eso_id
                    , $p_eso_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function estadosiafsel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_ess_id' => 'required|integer',
                'p_ess_activo' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_ess_id = $request->has('p_ess_id') ? (int) $request->input('p_ess_id') : 0;
                $p_ess_activo = $request->has('p_ess_activo') ? (int) $request->input('p_ess_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_estadosiaf_sel(?,?)", [
                    $p_ess_id
                    , $p_ess_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function tipobiensel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_tib_id' => 'required|integer',
                'p_tib_activo' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_tib_id = $request->has('p_tib_id') ? (int) $request->input('p_tib_id') : 0;
                $p_tib_activo = $request->has('p_tib_activo') ? (int) $request->input('p_tib_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_tipobien_sel(?,?)", [
                    $p_tib_id, $p_tib_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function tipobiencontrolsel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_tbc_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_tbc_id = $request->has('p_tbc_id') ? (int) $request->input('p_tbc_id') : 0;
                $p_tib_id = $request->has('p_tib_id') ? (int) $request->input('p_tib_id') : 0;
                $p_tbc_activo = $request->has('p_tbc_activo') ? (int) $request->input('p_tbc_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_tipobiencontrol_sel(?,?,?)", [
                    $p_tbc_id
                    , $p_tib_id
                    , $p_tbc_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function entregatipodocumentosel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_etd_id' => 'required|integer'
                , 'p_tib_id' => 'required|integer'
                , 'p_etd_activo' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_etd_id = $request->has('p_etd_id') ? (int) $request->input('p_etd_id') : 0;
                $p_tib_id = $request->has('p_tib_id') ? (int) $request->input('p_tib_id') : 0;
                $p_etd_activo = $request->has('p_etd_activo') ? (int) $request->input('p_etd_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_entregatipodocumento_sel(?,?,?)", [
                    $p_etd_id
                    , $p_tib_id
                    , $p_etd_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function entregaordinalsel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_eor_id' => 'required|integer'
                , 'p_eor_activo' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_eor_id = $request->has('p_eor_id') ? (int) $request->input('p_eor_id') : 0;
                $p_eor_activo = $request->has('p_eor_activo') ? (int) $request->input('p_eor_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_entregaordinal_sel(?,?)", [
                    $p_eor_id
                    , $p_eor_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function proveedorsel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_prv_id' => 'required|integer'
                , 'p_prv_activo' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_prv_id = $request->has('p_prv_id') ? (int) $request->input('p_prv_id') : 0;
                $p_prv_numruc = $request->has('p_prv_numruc') ? (string) $request->input('p_prv_numruc') : '';
                $p_prv_nomrso = $request->has('p_prv_nomrso') ? (string) $request->input('p_prv_nomrso') : '';
                $p_prv_activo = $request->has('p_prv_activo') ? (int) $request->input('p_prv_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_proveedor_sel(?,?,?,?)", [
                    $p_prv_id
                    , $p_prv_numruc
                    , $p_prv_nomrso
                    , $p_prv_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }
    
    public function conformidademi(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_cnf_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $p_cnf_id = (int) $request->input('p_cnf_id', 0);

            // 🔹 Consultamos el store
            $results = DB::select("SELECT * FROM adquisicion.spu_conformidad_emi(?)", [$p_cnf_id]);
            if (empty($results)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron datos para la conformidad.'
                ], 404);
            }

            $data = (array)$results[0];

            // 🔹 Renderizamos el HTML con Blade
            $pdf = Pdf::loadView('reportes.conformidad', ['data' => $data])
                    ->setPaper('A4', 'portrait');

            // 🔹 Convertimos a Base64
            $pdfBase64 = base64_encode($pdf->output());

            return response()->json([
                'success' => true,
                'message' => 'PDF generado correctamente.',
                'file_name' => 'CONFORMIDAD_'.$data['cnf_id'].'.pdf',
                'base64' => $pdfBase64
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al generar el PDF',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function conformidadlis(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                  'p_cnf_id' => 'required|integer',
                  'p_ent_id' => 'required|integer',
                  'p_usu_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_cnf_id = $request->has('p_cnf_id') ? (int) $request->input('p_cnf_id') : 0;
                $p_ent_id = $request->has('p_ent_id') ? (int) $request->input('p_ent_id') : 0;
                $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
                $p_cnf_permis = $request->input('p_cnf_permis');
                if (is_array($p_cnf_permis)) {
                    $p_cnf_permis = json_encode($p_cnf_permis, JSON_UNESCAPED_UNICODE);
                }

                //echo "SELECT * FROM adquisicion.spu_conformidad_lis($p_cnf_id,$p_ent_id,$p_usu_id,'$p_cnf_permis')";

                $results = DB::select("SELECT * FROM adquisicion.spu_conformidad_lis(?,?,?,?)", [
                      $p_cnf_id
                    , $p_ent_id
                    , $p_usu_id
                    , $p_cnf_permis
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }
    
    public function conformidadgra(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_cnf_id'       => 'required|integer',
            'p_ent_id'       => 'required|integer',
            'p_cnf_fecemi'   => 'nullable|string',
            'p_cnf_monpre'   => 'nullable|numeric',
            'p_cnf_cumpre'   => 'required|integer',
            'p_cnf_cumplz'   => 'required|integer',
            'p_cnf_conent'   => 'required|integer',
            'p_cnf_cuprau'   => 'required|integer',
            'p_cnf_observ'   => 'nullable|string',
            'p_cnf_usureg'   => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try {
            $p_cnf_id     = (int) $request->input('p_cnf_id', 0);
            $p_ent_id     = (int) $request->input('p_ent_id', 0);
            $p_cnf_fecemi = $request->input('p_cnf_fecemi', '');
            $p_cnf_monpre = (float) $request->input('p_cnf_monpre', 0);
            $p_cnf_cumpre = (int) $request->input('p_cnf_cumpre', 0);
            $p_cnf_cumplz = (int) $request->input('p_cnf_cumplz', 0);
            $p_cnf_conent = (int) $request->input('p_cnf_conent', 0);
            $p_cnf_cuprau = (int) $request->input('p_cnf_cuprau', 0);
            $p_cnf_observ = $request->input('p_cnf_observ', '');
            $p_cnf_usureg = (int) $request->input('p_cnf_usureg', 0);

            //echo "SELECT * FROM adquisicion.spu_conformidad_gra($p_cnf_id,$p_ent_id,'$p_cnf_fecemi',$p_cnf_monpre,$p_cnf_cumpre,$p_cnf_cumplz,$p_cnf_conent,$p_cnf_cuprau,'$p_cnf_observ',$p_cnf_usureg)";

            $results = DB::select("SELECT * FROM adquisicion.spu_conformidad_gra(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                $p_cnf_id,
                $p_ent_id,
                $p_cnf_fecemi,
                $p_cnf_monpre,
                $p_cnf_cumpre,
                $p_cnf_cumplz,
                $p_cnf_conent,
                $p_cnf_cuprau,
                $p_cnf_observ,
                $p_cnf_usureg
            ]);

            return response()->json([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar o actualizar la conformidad',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function ordenimp(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_imp_usureg' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ], 400, ['Content-Type' => 'application/json; charset=utf-8']);
        }

        try {
            $p_imp_nomfil = (string) $request->input('p_imp_nomfil', '');
            $p_imp_jsdata = (string) $request->input('p_imp_jsdata', '');
            $p_imp_usureg = (int) $request->input('p_imp_usureg', 0);

            $decoded = json_decode($p_imp_jsdata, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {

                // 🔹 Ruta fija en unidad D: (tu entorno real)
                $basePath = 'D:\\ADQUISICION\\';

                foreach ($decoded as &$row) {
                    foreach ($row as $key => &$value) {
                        if (is_string($value)) {
                            $value = preg_replace('/[\x00-\x1F\x7F-\x9F]/u', ' ', $value);
                            if (function_exists('normalizer_normalize')) {
                                $value = normalizer_normalize($value, Normalizer::FORM_C);
                            }
                            $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8, ISO-8859-1, Windows-1252');
                            $value = str_replace(
                                ['Ã¡', 'Ã©', 'Ãí', 'Ã³', 'Ãº', 'ÃÁ', 'ÃÉ', 'ÃÍ', 'ÃÓ', 'ÃÚ',
                                'Ã±', 'Ã‘', 'Â¿', 'Â¡', 'Â', '�'],
                                ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú',
                                'ñ', 'Ñ', '¿', '¡', '', ''],
                                $value
                            );
                            $value = trim($value);
                        }
                    }

                    $tipo = isset($row['fk_id_orden_tipo']) ? (int) $row['fk_id_orden_tipo'] : 0;
                    if ($tipo !== 1 && $tipo !== 2) {
                        continue;
                    }

                    $anio = isset($row['in_orden_anno']) ? (int) $row['in_orden_anno'] : date('Y');
                    $numero = isset($row['vc_orden_numero']) ? (int) $row['vc_orden_numero'] : 0;
                    $tipoFolder = $tipo === 1 ? 'OC' : 'OS';
                    $num4 = str_pad($numero, 4, '0', STR_PAD_LEFT);
                    $subFolder = "{$tipoFolder}-{$num4}-{$anio}";

                    $tipoPath = $basePath . $tipoFolder;
                    $finalPath = $tipoPath . DIRECTORY_SEPARATOR . $subFolder;

                    if (!File::exists($tipoPath)) {
                        File::makeDirectory($tipoPath, 0777, true);
                    }

                    if (!File::exists($finalPath)) {
                        File::makeDirectory($finalPath, 0777, true);
                    }

                    // 🔸 Guardamos ruta completa en el JSON
                    $row['ruta_carpeta'] = $finalPath;
                }

                unset($row);

                $p_imp_jsdata = json_encode($decoded, JSON_UNESCAPED_UNICODE);
            } else {
                $p_imp_jsdata = mb_convert_encoding($p_imp_jsdata, 'UTF-8', 'auto');
            }

            DB::statement("SET client_encoding TO 'UTF8'");
            $results = DB::select("SELECT * FROM adquisicion.spu_orden_imp(?,?,?)", [
                $p_imp_nomfil,
                $p_imp_jsdata,
                $p_imp_usureg
            ]);

            return response()->json(
                $results,
                200,
                ['Content-Type' => 'application/json; charset=utf-8'],
                JSON_UNESCAPED_UNICODE
            );

        } catch (\Throwable $e) {
            return response()->json([
                'error' => -999,
                'mensa' => 'Error al procesar archivo: ' . $e->getMessage()
            ], 500, ['Content-Type' => 'application/json; charset=utf-8']);
        }
    }

    public function especialistasel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_esp_id' => 'required|integer',
                'p_usu_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_esp_id = $request->has('p_esp_id') ? (int) $request->input('p_esp_id') : 0;
                $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
                $p_esp_apepat = $request->has('p_esp_apepat') ? (string) $request->input('p_esp_apepat') : '';
                $p_esp_apemat = $request->has('p_esp_apemat') ? (string) $request->input('p_esp_apemat') : '';
                $p_esp_nombre = $request->has('p_esp_nombre') ? (string) $request->input('p_esp_nombre') :  '';
                $p_esp_activo = $request->has('p_esp_activo') ? (int) $request->input('p_esp_activo') : 0;

                $results = DB::select("SELECT * FROM adquisicion.spu_especialista_sel(?,?,?,?,?,?)", [
                    $p_esp_id,$p_usu_id,$p_esp_apepat,$p_esp_apemat,$p_esp_nombre,$p_esp_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function especialistaard(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_esp_id' => 'required|integer',
                'p_ard_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_esp_id = $request->has('p_esp_id') ? (int) $request->input('p_esp_id') : 0;
                $p_ard_id = $request->has('p_ard_id') ? (int) $request->input('p_ard_id') : 0;

                $results = DB::select("SELECT * FROM adquisicion.spu_especialista_ard(?,?)", [
                    $p_esp_id,$p_ard_id
                ]);

                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function ordensel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_ord_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_ord_id = $request->has('p_ord_id') ? (int) $request->input('p_ord_id') : 0;
                $p_ord_numero = $request->has('p_ord_numero') ? (string) $request->input('p_ord_numero') : '';
                $p_ord_numruc = $request->has('p_ord_numruc') ? (string) $request->input('p_ord_numruc') : '';
                $p_tib_id = $request->has('p_tib_id') ? (int) $request->input('p_tib_id') : 0;
                $p_eso_id = $request->has('p_eso_id') ? (int) $request->input('p_eso_id') : 0;
                $p_ess_id = $request->has('p_ess_id') ? (int) $request->input('p_ess_id') : 0;
                $p_ard_id = $request->has('p_ard_id') ? (int) $request->input('p_ard_id') : 0;
                $p_esp_id = $request->has('p_esp_id') ? (int) $request->input('p_esp_id') : 0;
                $p_ord_fecini = $request->has('p_ord_fecini') ? (string) $request->input('p_ord_fecini') : '';
                $p_ord_fecfin = $request->has('p_ord_fecfin') ? (string) $request->input('p_ord_fecfin') : '';
                $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
                
                $p_ord_permis = $request->input('p_ord_permis');
                if (is_array($p_ord_permis)) {
                    $p_ord_permis = json_encode($p_ord_permis, JSON_UNESCAPED_UNICODE);
                }
                
                // echo "SELECT * FROM adquisicion.spu_orden_sel($p_ord_id,'$p_ord_numero','$p_ord_numruc',$p_tib_id,$p_eso_id,$p_ess_id,$p_ard_id,'$p_ord_fecini','$p_ord_fecfin',$p_usu_id,'$p_ord_permis')";

                /* $results = DB::select("SELECT * FROM adquisicion.spu_orden_sel(?,?,?,?,?,?,?,?,?,?,?,?)", [
                    $p_ord_id,$p_ord_numero,$p_ord_numruc,$p_tib_id,$p_eso_id,$p_ess_id,$p_ard_id,$p_esp_id,$p_ord_fecini,$p_ord_fecfin,$p_usu_id,$p_ord_permis
                ]); */

                $results = DB::select("SELECT * FROM adquisicion.spu_orden_sel(?)", [
                    $p_ord_id
                ]);

                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }
    
    public function entregadocumentoslis(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_edo_id' => 'required|integer',
                'p_ent_id' => 'required|integer',
                'p_etd_id' => 'required|integer',
                'p_usu_id' => 'required|integer',
                'p_edo_activo' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_edo_id = $request->has('p_edo_id') ? (int) $request->input('p_edo_id') : 0;
                $p_ent_id = $request->has('p_ent_id') ? (int) $request->input('p_ent_id') : 0;
                $p_etd_id = $request->has('p_etd_id') ? (int) $request->input('p_etd_id') : 0;
                $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
                $p_ent_permis = $request->input('p_ent_permis');
                if (is_array($p_ent_permis)) {
                    $p_ent_permis = json_encode($p_ent_permis, JSON_UNESCAPED_UNICODE);
                }
                $p_edo_activo = $request->has('p_edo_activo') ? (int) $request->input('p_edo_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_entregadocumentos_lis(?,?,?,?,?,?)", [
                    $p_edo_id,$p_ent_id,$p_etd_id,$p_usu_id,$p_ent_permis,$p_edo_activo
                ]);

                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function entregadocumentosgra(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_ent_id' => 'required|integer',
            'p_usu_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $p_ent_id = (int) $request->input('p_ent_id', 0);
            $p_usu_id = (int) $request->input('p_usu_id', 0);
            $fechaHoy = now()->format('Y-m-d');
            $savedFiles = [];

            if (!$request->hasFile('files') || count($request->file('files')) === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se recibieron archivos para procesar.'
                ], 400);
            }

            foreach ($request->file('files') as $file) {
                if (!$file->isValid()) continue;
                $originalName = $file->getClientOriginalName();
                $nombreSinExt = pathinfo($originalName, PATHINFO_FILENAME);
                $nombreLimpio = preg_replace('/[^A-Za-z0-9]/', '_', $nombreSinExt);
                $extension = $file->getClientOriginalExtension();
                $nuevoNombre = strtoupper($nombreLimpio . '.' . $extension);
                $tamanoarchivo = (int) $file->getSize();
                $results = DB::select("SELECT * FROM adquisicion.spu_entregadocumentos_gra(?,?,?,?,?,?,?,?,?)", [
                    0,                  // p_edo_id
                    $p_ent_id,          // p_ent_id
                    0,                  // p_tdo_id
                    $nombreSinExt,      // p_edo_numdoc
                    $fechaHoy,          // p_edo_fecemi
                    $nuevoNombre,       // p_edo_nomfil
                    $tamanoarchivo,     // p_edo_tamfil
                    '',                 // p_edo_observ
                    $p_usu_id           // p_edo_usureg
                ]);

                if (empty($results) || !isset($results[0]->mensa)) {
                    $savedFiles[] = [
                        'file' => $nuevoNombre,
                        'status' => 'error',
                        'message' => 'El procedimiento no devolvió una ruta válida.'
                    ];
                    continue;
                }

                $rutaInfo = trim($results[0]->mensa);
                $partes = explode('|', $rutaInfo);
                $rutaBase = isset($partes[0]) ? trim($partes[0]) : '';
                $archivoRemoto = isset($partes[1]) ? trim($partes[1]) : '';
                $rutaBaseLocal = str_replace(
                    ['10.250.55.118/adquisicion','http://10.250.55.118/adquisicion','https://10.250.55.118/adquisicion'],
                    ['C:\\xampp\\htdocs\\adquisicion'],
                    $rutaBase
                );

                $carpetaDestino = rtrim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $rutaBaseLocal), DIRECTORY_SEPARATOR);
                if (!File::exists($carpetaDestino)) {
                    File::makeDirectory($carpetaDestino, 0777, true);
                }
                @chmod($carpetaDestino, 0777);

                $rutaFinal = $carpetaDestino . DIRECTORY_SEPARATOR . $nuevoNombre;
                $rutaFinal = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $rutaFinal);
                $realPath = $file->getRealPath();

                $moved = false;
                if (is_uploaded_file($realPath)) {
                    $moved = @move_uploaded_file($realPath, $rutaFinal);
                }
                if (!$moved) {
                    $moved = @File::copy($realPath, $rutaFinal);
                }
                if (!$moved) {
                    throw new \Exception("No se pudo mover o copiar el archivo a {$rutaFinal}");
                }

                $savedFiles[] = [
                    'file' => $nuevoNombre,
                    'size_bytes' => $tamanoarchivo,
                    'ruta' => $rutaFinal,
                    'status' => 'ok',
                    'mensa' => $results[0]->mensa
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Archivos procesados correctamente.',
                'archivos' => $savedFiles
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar los documentos de entrega.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    
    public function ordenlis(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_ord_id'   => 'required|integer',
            'p_tib_id'   => 'required|integer',
            'p_eso_id'   => 'required|integer',
            'p_ess_id'   => 'required|integer',
            'p_ard_id'   => 'required|integer',
            'p_usu_id'   => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'  => -1,
                'mensa'  => 'Error en la validación de datos.',
                'errors' => $validator->errors()
            ], 400, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        try {
            DB::statement("SET client_encoding TO 'UTF8'");

            $p_ord_id     = (int) $request->input('p_ord_id', 0);
            $p_ord_numero = (string) $request->input('p_ord_numero', '');
            $p_ord_numruc = (string) $request->input('p_ord_numruc', '');
            $p_tib_id     = (int) $request->input('p_tib_id', 0);
            $p_eso_id     = (int) $request->input('p_eso_id', 0);
            $p_ess_id     = (int) $request->input('p_ess_id', 0);
            $p_ard_id     = (int) $request->input('p_ard_id', 0);
            $p_esp_id     = (int) $request->input('p_esp_id', 0);
            $p_ord_fecini = (string) $request->input('p_ord_fecini', '');
            $p_ord_fecfin = (string) $request->input('p_ord_fecfin', '');
            $p_usu_id     = (int) $request->input('p_usu_id', 0);

            $p_ord_permis = $request->input('p_ord_permis');
            if (is_array($p_ord_permis)) {
                $p_ord_permis = json_encode($p_ord_permis, JSON_UNESCAPED_UNICODE);
            }
            //echo "SELECT * FROM adquisicion.spu_orden_lis($p_ord_id,'$p_ord_numero','$p_ord_numruc',$p_tib_id,$p_eso_id,$p_ess_id,$p_ard_id,$p_esp_id,'$p_ord_fecini','$p_ord_fecfin',$p_usu_id,'$p_ord_permis')";
            $results = DB::select(
                "SELECT * FROM adquisicion.spu_orden_lis(?,?,?,?,?,?,?,?,?,?,?,?)",
                [ $p_ord_id, $p_ord_numero, $p_ord_numruc, $p_tib_id, $p_eso_id, $p_ess_id, $p_ard_id, $p_esp_id, $p_ord_fecini, $p_ord_fecfin, $p_usu_id, $p_ord_permis]
            );

            return response()
                ->json($results, 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => -999,
                'mensa' => 'Error al obtener los datos: ' . $e->getMessage()
            ], 500, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function entregasel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_ent_id' => 'required|integer'
                , 'p_ord_id' => 'required|integer'
                , 'p_etd_id' => 'required|integer'
                , 'p_tbc_id' => 'required|integer'
                , 'p_ent_activo' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_ent_id = $request->has('p_ent_id') ? (int) $request->input('p_ent_id') : 0;
                $p_ord_id = $request->has('p_ord_id') ? (int) $request->input('p_ord_id') : 0;
                $p_etd_id = $request->has('p_etd_id') ? (int) $request->input('p_etd_id') : 0;
                $p_tbc_id = $request->has('p_tbc_id') ? (int) $request->input('p_tbc_id') : 0;
                $p_ent_fecdoi = $request->has('p_ent_fecdoi') ? (string) $request->input('p_ent_fecdoi') : '';
                $p_ent_fecdof = $request->has('p_ent_fecdof') ? (string) $request->input('p_ent_fecdof') : '';
                $p_ent_fecrei = $request->has('p_ent_fecrei') ? (string) $request->input('p_ent_fecrei') : '';
                $p_ent_fecref = $request->has('p_ent_fecref') ? (string) $request->input('p_ent_fecref') : '';
                $p_ent_activo = $request->has('p_ent_activo') ? (int) $request->input('p_ent_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_entrega_sel(?,?,?,?,?,?,?,?,?)", [
                    $p_ent_id
                    , $p_ord_id
                    , $p_etd_id
                    , $p_tbc_id
                    , $p_ent_fecdoi
                    , $p_ent_fecdof
                    , $p_ent_fecrei
                    , $p_ent_fecref
                    , $p_ent_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function entregagra(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
              'p_ent_id' => 'required|integer'
            , 'p_ord_id' => 'required|integer'
            , 'p_tbc_id' => 'required|integer'
            , 'p_eor_id' => 'required|integer'
            , 'p_ent_usureg' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }
        try
        {
            $p_ent_id = $request->has('p_ent_id') ? (int) $request->input('p_ent_id') : 0;
            $p_ord_id = $request->has('p_ord_id') ? (int) $request->input('p_ord_id') : 0;
            $p_tbc_id = $request->has('p_tbc_id') ? (int) $request->input('p_tbc_id') : 0;
            $p_eor_id = $request->has('p_eor_id') ? (int) $request->input('p_eor_id') : 0;
            $p_ent_fecent = $request->has('p_ent_fecent') ? (string) $request->input('p_ent_fecent') : '';
            $p_ent_fecrec = $request->has('p_ent_fecrec') ? (string) $request->input('p_ent_fecrec') : '';
            $p_ent_observ = $request->has('p_ent_observ') ? (string) $request->input('p_ent_observ') : '';
            $p_ent_usureg = $request->has('p_ent_usureg') ? (int) $request->input('p_ent_usureg') : 0;
            $results = DB::select('SELECT * FROM adquisicion.spu_entrega_gra(?,?,?,?,?,?,?,?)', [
                  $p_ent_id,$p_ord_id,$p_tbc_id,$p_eor_id,$p_ent_fecent,$p_ent_fecrec,$p_ent_observ,$p_ent_usureg]);
            return response()->json($results);
        }
        catch (\Exception $e)
        {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
        }
    }
    
    public function entregalis(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_ent_id' => 'required|integer'
            , 'p_ord_id' => 'required|integer'
            , 'p_tbc_id' => 'required|integer'
            , 'p_eor_id' => 'required|integer'
            , 'p_usu_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try
        {
            $p_ent_id = $request->has('p_ent_id') ? (int) $request->input('p_ent_id') : 0;
            $p_ord_id = $request->has('p_ord_id') ? (int) $request->input('p_ord_id') : 0;
            $p_tbc_id = $request->has('p_tbc_id') ? (int) $request->input('p_tbc_id') : 0;
            $p_eor_id = $request->has('p_eor_id') ? (int) $request->input('p_eor_id') : 0;
            $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
            $p_ent_fecrei = $request->has('p_ent_fecrei') ? (string) $request->input('p_ent_fecrei') : '';
            $p_ent_fecref = $request->has('p_ent_fecref') ? (string) $request->input('p_ent_fecref') : '';
            $p_ent_permis = $request->input('p_ent_permis'); 
            if (is_array($p_ent_permis)) {
                $p_ent_permis = json_encode($p_ent_permis, JSON_UNESCAPED_UNICODE);
            }
            $p_ent_activo = $request->has('p_ent_activo') ? (int) $request->input('p_ent_activo') : 1;

            $results = DB::select('SELECT * FROM adquisicion.spu_entrega_lis(?,?,?,?,?,?,?,?,?)', [
                $p_ent_id,$p_ord_id,$p_tbc_id,$p_eor_id,$p_usu_id,$p_ent_fecrei,$p_ent_fecref,$p_ent_permis,$p_ent_activo]);

            return response()->json($results);
        }
        catch (\Exception $e)
        {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    public function proveedorgra(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_prv_usureg' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try
        {
            $p_prv_numruc = $request->has('p_prv_numruc') ? (string) $request->input('p_prv_numruc') : '';
            $p_prv_nomrso = $request->has('p_prv_nomrso') ? (string) $request->input('p_prv_nomrso') : '';
            $p_prv_usureg = $request->has('p_prv_usureg') ? (int) $request->input('p_prv_usureg') : 0;

            $results = DB::select('SELECT * FROM adquisicion.spu_proveedor_gra(?,?,?)', [
                $p_prv_numruc
                , $p_prv_nomrso
                , $p_prv_usureg]);

            return response()->json($results);
        }
        catch (\Exception $e)
        {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    public function ordenmig(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_ord_usureg' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try
        {
            $p_ord_jsdata = $request->input('p_ord_jsdata');
            if (is_array($p_ord_jsdata)) {
                $p_ord_jsdata = json_encode($p_ord_jsdata, JSON_UNESCAPED_UNICODE);
            }
            $p_ord_usureg = $request->has('p_ord_usureg') ? (int) $request->input('p_ord_usureg') : 1;

            $results = DB::select('SELECT * FROM adquisicion.spu_orden_mig(?,?)', [
                $p_ord_jsdata
                , $p_prv_usureg]);

            return response()->json($results);
        }
        catch (\Exception $e)
        {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    public function ordenupd(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
              'p_ord_id' => 'required|integer',
              'p_ard_id' => 'required|integer', 
              'p_esp_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try
        {
            $p_ord_id = $request->has('p_ord_id') ? (int) $request->input('p_ord_id') : 0;
            $p_ard_id = $request->has('p_ard_id') ? (int) $request->input('p_ard_id') : 0;
            $p_esp_id = $request->has('p_esp_id') ? (int) $request->input('p_esp_id') : 0;
            $p_ord_canent = $request->has('p_ord_canent') ? (int) $request->input('p_ord_canent') : 0;
            $p_ord_nusiaf = $request->has('p_ord_nusiaf') ? (int) $request->input('p_ord_nusiaf') : 0;
            $p_ord_fecnot = $request->has('p_ord_fecnot') ? (string) $request->input('p_ord_fecnot') : '';
            $p_ord_fecrec = $request->has('p_ord_fecrec') ? (string) $request->input('p_ord_fecrec') : '';
            $p_ord_docref = $request->has('p_ord_docref') ? (string) $request->input('p_ord_docref') : '';
            $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
            
            //echo "SELECT * FROM adquisicion.spu_orden_upd($p_ord_id,$p_ard_id,$p_esp_id,$p_ord_canent,$p_ord_nusiaf,'$p_ord_docref','$p_ord_fecnot','$p_ord_fecrec',$p_usu_id)";

            $results = DB::select('SELECT * FROM adquisicion.spu_orden_upd(?,?,?,?,?,?,?,?,?)', [
                $p_ord_id,$p_ard_id,$p_esp_id,$p_ord_canent,$p_ord_nusiaf,$p_ord_docref,$p_ord_fecnot,$p_ord_fecrec,$p_usu_id
            ]);

            return response()->json($results);
        }
        catch (\Exception $e)
        {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    public function conformidaddocumentogra(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'p_cnf_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try {
            $p_cnf_id = (int) $request->input('p_cnf_id', 0);

            if (!$request->hasFile('files')) {
                return response()->json(['success' => false, 'message' => 'No se recibió ningún archivo.'], 400);
            }

            $file = $request->file('files');
            if (!$file->isValid()) {
                return response()->json(['success' => false, 'message' => 'Archivo no válido.'], 400);
            }

            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $nombreBase = pathinfo($originalName, PATHINFO_FILENAME);
            $nombreLimpio = preg_replace('/[^A-Za-z0-9]/', '_', $nombreBase);
            $nuevoNombre = strtoupper($nombreLimpio . '.' . $extension);

            $results = DB::select("SELECT * FROM adquisicion.spu_conformidaddocumento_gra(?, ?)", [
                $p_cnf_id,
                $nuevoNombre
            ]);

            $rutaInfo = trim($results[0]->mensa ?? '');
            $rutaLocal = str_replace(
                ['10.250.55.118/adquisicion', 'http://10.250.55.118/adquisicion'],
                ['C:\\xampp\\htdocs\\adquisicion'],
                $rutaInfo
            );
            $rutaLocal = str_replace(['/', '\\\\'], DIRECTORY_SEPARATOR, $rutaLocal);
            $carpetaDestino = dirname($rutaLocal);

            if (!File::exists($carpetaDestino)) {
                File::makeDirectory($carpetaDestino, 0777, true, true);
            }

            $file->move($carpetaDestino, $nuevoNombre);

            $urlPublica = str_replace(
                ['C:\\xampp\\htdocs\\adquisicion', 'C:/xampp/htdocs/adquisicion'],
                ['http://10.250.55.118/adquisicion'],
                $rutaLocal
            );
            $urlPublica = str_replace(DIRECTORY_SEPARATOR, '/', $urlPublica);

            return response()->json([
                'success' => true,
                'message' => 'Documento de conformidad registrado correctamente.',
                'ruta'    => $rutaLocal,
                'url'     => $urlPublica,
                'dato'    => $results[0]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el documento.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function conformidaddocumentoanu(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'p_cnf_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Error en los datos', 'errors' => $validator->errors()], 400);
        }

        try {
            $p_cnf_id = (int)$request->input('p_cnf_id', 0);
            $results = DB::select("SELECT * FROM adquisicion.spu_conformidaddocumento_anu(?)", [$p_cnf_id]);
            return response()->json($results);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Error al anular documento', 'error' => $e->getMessage()], 500);
        }
    }

    public function ordendocumentoreg(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_ord_id' => 'required|integer',
            'p_usu_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try {
            $p_ord_id = (int) $request->input('p_ord_id', 0);
            $p_usu_id = (int) $request->input('p_usu_id', 0);

            if (!$request->hasFile('files')) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se recibió ningún archivo.'
                ], 400);
            }

            $file = $request->file('files');
            if (!$file->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Archivo no válido.'
                ], 400);
            }

            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $nombreBase = pathinfo($originalName, PATHINFO_FILENAME);
            $nombreLimpio = preg_replace('/[^A-Za-z0-9]/', '_', $nombreBase);
            $nuevoNombre = strtoupper($nombreLimpio . '.' . $extension);
            $results = DB::select("SELECT * FROM adquisicion.spu_ordendocumento_reg(?, ?)", [
                $p_ord_id,
                $nuevoNombre
            ]);

            if (empty($results) || !isset($results[0]->error)) {
                throw new \Exception("El procedimiento no devolvió una respuesta válida.");
            }
            $rutaInfo = trim($results[0]->mensa ?? '');
            if (empty($rutaInfo)) {
                throw new \Exception("El procedimiento no devolvió una ruta válida.");
            }
            $rutaInfo = str_replace('|', '', $rutaInfo);
            $rutaInfo = trim($rutaInfo);
            $rutaLocal = str_replace(
                ['10.250.55.118/adquisicion', 'http://10.250.55.118/adquisicion', 'https://10.250.55.118/adquisicion'],
                ['C:\\xampp\\htdocs\\adquisicion'],
                $rutaInfo
            );
            $rutaLocal = str_replace(['/', '\\\\'], DIRECTORY_SEPARATOR, $rutaLocal);
            $carpetaDestino = dirname($rutaLocal);
            if (!File::exists($carpetaDestino)) {
                File::makeDirectory($carpetaDestino, 0777, true, true);
            }
            @chmod($carpetaDestino, 0777);
            $realPath = $file->getRealPath();
            $rutaDestinoFinal = $carpetaDestino . DIRECTORY_SEPARATOR . $nuevoNombre;
            $moved = false;
            if (is_uploaded_file($realPath)) {
                $moved = @move_uploaded_file($realPath, $rutaDestinoFinal);
            }
            if (!$moved) {
                $moved = @File::copy($realPath, $rutaDestinoFinal);
            }
            if (!$moved) {
                throw new \Exception("No se pudo mover o copiar el archivo a {$rutaDestinoFinal}");
            }
            $urlPublica = str_replace(
                ['C:\\xampp\\htdocs\\adquisicion', 'C:/xampp/htdocs/adquisicion'],
                ['http://10.250.55.118/adquisicion'],
                $rutaDestinoFinal
            );
            $urlPublica = str_replace(DIRECTORY_SEPARATOR, '/', $urlPublica);

            return response()->json([
                'success' => true,
                'message' => 'Documento de orden registrado correctamente.',
                'file'    => $nuevoNombre,
                'ruta'    => $rutaDestinoFinal,
                'url'     => $urlPublica,  // 🔹 URL HTTP lista para abrir en navegador
                'dato'    => $results[0]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el documento de la orden.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function ordendocumentoanu(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
              'p_ord_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try
        {
            $p_ord_id = $request->has('p_ord_id') ? (int) $request->input('p_ord_id') : 0;

            $results = DB::select('SELECT * FROM adquisicion.spu_ordendocumento_anu(?)', [
                $p_ord_id
            ]);

            return response()->json($results);
        }
        catch (\Exception $e)
        {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    public function entregadocumentosanu(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
              'p_edo_id' => 'required|integer',
              'p_edo_usureg' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors'  => $validator->errors()
            ], 400);
        }

        try
        {
            $p_edo_id = $request->has('p_edo_id') ? (int) $request->input('p_edo_id') : 0;
            $p_edo_usureg = $request->has('p_edo_usureg') ? (int) $request->input('p_edo_usureg') : 0;

            $results = DB::select('SELECT * FROM adquisicion.spu_entregadocumentos_anu(?,?)', [
                $p_edo_id,$p_edo_usureg
            ]);

            return response()->json($results);
        }
        catch (\Exception $e)
        {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    public function entregadocumentossel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                  'p_edo_id' => 'required|integer'
                , 'p_ent_id' => 'required|integer'
                , 'p_etd_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }

            try {
                $p_edo_id = $request->has('p_edo_id') ? (int) $request->input('p_edo_id') : 0;
                $p_ent_id = $request->has('p_ent_id') ? (int) $request->input('p_ent_id') : 0;
                $p_etd_id = $request->has('p_etd_id') ? (int) $request->input('p_etd_id') : 0;
                $p_edo_activo = $request->has('p_edo_activo') ? (int) $request->input('p_edo_activo') : 1;

                $results = DB::select("SELECT * FROM adquisicion.spu_entregadocumentos_sel(?,?,?,?)", [
                      $p_edo_id
                    , $p_ent_id
                    , $p_etd_id
                    , $p_edo_activo
                ]);
                return response()->json($results);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener los datos',
                    'error' => $e->getMessage()
                ], 500);
            }
    }

    public function getfile(Request $request){
        $validator = Validator::make($request->all(), [
            'file_path' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ruta de archivo no proporcionada',
                'errors' => $validator->errors()
            ], 400);
        }
        try {
            $filePath = urldecode($request->input('file_path'));
            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo no existe',
                    'path' => $filePath
                ], 404);
            }
            $mimeType = mime_content_type($filePath);
            $fileName = basename($filePath);
            $fileSize = filesize($filePath);
            $publicPath = str_replace(['D:\\ADQUISICION', 'D:/ADQUISICION'], 'files', $filePath);
            $publicUrl = asset(str_replace('\\', '/', $publicPath));
            if ($fileSize > 20 * 1024 * 1024) {
                return response()->json([
                    'success' => true,
                    'isLargeFile' => true,
                    'url' => $publicUrl,
                    'mime_type' => $mimeType,
                    'file_name' => $fileName,
                    'file_size' => $fileSize
                ]);
            }
            if ($fileSize > 5 * 1024 * 1024) {
                return response()->stream(function () use ($filePath) {
                    $handle = fopen($filePath, 'rb');
                    while (!feof($handle)) {
                        echo fread($handle, 8192);
                        ob_flush();
                        flush();
                    }
                    fclose($handle);
                }, 200, [
                    'Content-Type'        => $mimeType,
                    'Content-Length'      => $fileSize,
                    'Accept-Ranges'       => 'bytes',
                    'Content-Range'       => 'bytes 0-' . ($fileSize - 1) . '/' . $fileSize,
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"',
                    'Cache-Control'       => 'private, max-age=0, no-store',
                    'Pragma'              => 'no-cache',
                    'Expires'             => '0',
                ]);
            }
            $base64 = base64_encode(file_get_contents($filePath));
            return response()->json([
                'success' => true,
                'isLargeFile' => false,
                'data' => [
                    'content' => $base64,
                    'mime_type' => $mimeType,
                    'file_name' => $fileName,
                    'file_size' => $fileSize
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al leer el archivo',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}