<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AdquisicionController extends Controller
{   
    public function estadoordensel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_eso_id' => 'required|integer'
                , 'p_eso_activo' => 'required|integer'
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
                'p_ess_id' => 'required|integer'
                , 'p_ess_activo' => 'required|integer'
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
                'p_tib_id' => 'required|integer'
                , 'p_tib_activo' => 'required|integer'
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
                    $p_tib_id
                    , $p_tib_activo
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
                , 'p_tib_id' => 'required|integer'
                , 'p_tbc_activo' => 'required|integer'
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

    public function ordensel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_ord_id' => 'required|integer'
                , 'p_ord_numero' => 'required|integer'
                , 'p_prv_id' => 'required|integer'
                , 'p_tib_id' => 'required|integer'
                , 'p_eso_id' => 'required|integer'
                , 'p_ess_id' => 'required|integer'
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
                $p_ord_numero = $request->has('p_ord_numero') ? (int) $request->input('p_ord_numero') : 0;
                $p_prv_id = $request->has('p_prv_id') ? (int) $request->input('p_prv_id') : 0;
                $p_tib_id = $request->has('p_tib_id') ? (int) $request->input('p_tib_id') : 0;
                $p_eso_id = $request->has('p_eso_id') ? (int) $request->input('p_eso_id') : 0;
                $p_ess_id = $request->has('p_ess_id') ? (int) $request->input('p_ess_id') : 0;
                $p_ord_fecini = $request->has('p_ord_fecini') ? (string) $request->input('p_ord_fecini') : '';
                $p_ord_fecfin = $request->has('p_ord_fecfin') ? (string) $request->input('p_ord_fecfin') : '';

                $results = DB::select("SELECT * FROM adquisicion.spu_orden_sel(?,?,?,?,?,?,?,?)", [
                    $p_ord_id
                    , $p_ord_numero
                    , $p_prv_id
                    , $p_tib_id
                    , $p_eso_id
                    , $p_ess_id
                    , $p_ord_fecini
                    , $p_ord_fecfin
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
            , 'p_etd_id' => 'required|integer'
            , 'p_tbc_id' => 'required|integer'
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
            $p_etd_id = $request->has('p_etd_id') ? (int) $request->input('p_etd_id') : 0;
            $p_tbc_id = $request->has('p_tbc_id') ? (int) $request->input('p_tbc_id') : 0;
            $p_ent_numdoc = $request->has('p_ent_numdoc') ? (string) $request->input('p_ent_numdoc') : '';
            $p_ent_fecdoc = $request->has('p_ent_fecdoc') ? (string) $request->input('p_ent_fecdoc') : '';
            $p_ent_fecrec = $request->has('p_ent_fecrec') ? (string) $request->input('p_ent_fecrec') : '';
            $p_ent_fileoc = $request->has('p_ent_fileoc') ? (string) $request->input('p_ent_fileoc') : '';
            $p_ent_filegr = $request->has('p_ent_filegr') ? (string) $request->input('p_ent_filegr') : '';
            $p_ent_observ = $request->has('p_ent_observ') ? (string) $request->input('p_ent_observ') : '';
            $p_ent_usureg = $request->has('p_ent_usureg') ? (int) $request->input('p_ent_usureg') : 0;

            $results = DB::select('SELECT * FROM adquisicion.spu_entrega_gra(?,?,?,?,?,?,?,?,?,?,?)', [
                $p_ent_id
                , $p_ord_id
                , $p_etd_id
                , $p_tbc_id
                , $p_ent_numdoc
                , $p_ent_fecdoc
                , $p_ent_fecrec
                , $p_ent_fileoc
                , $p_ent_filegr
                , $p_ent_observ
                , $p_ent_usureg]);

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
                if (is_array($p_ord_jsdata)) {$p_ord_jsdata = json_encode($p_ord_jsdata, JSON_UNESCAPED_UNICODE);}
            $p_prv_usureg = $request->has('p_prv_usureg') ? (int) $request->input('p_prv_usureg') : 1;

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
            'p_ord_id' => 'required|integer'
            , 'p_ard_id' => 'required|integer'
            , 'p_ord_nument' => 'required|integer'
            , 'p_ord_nusiaf' => 'required|integer'
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
            $p_ard_id = $request->has('p_ard_id') ? (int) $request->input('p_ard_id') : 0;
            $p_ord_nument = $request->has('p_ord_nument') ? (int) $request->input('p_ord_nument') : 1;
            $p_ord_nusiaf = $request->has('p_ord_nusiaf') ? (int) $request->input('p_ord_nusiaf') : 0;

            $results = DB::select('SELECT * FROM adquisicion.spu_orden_upd(?,?,?,?)', [
                $p_ent_id
                , $p_ard_id
                , $p_ord_nument
                , $p_ord_nusiaf]);

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
}