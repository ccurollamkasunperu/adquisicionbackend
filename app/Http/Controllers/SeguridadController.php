<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class SeguridadController extends Controller
{    
    public function permisoobjetosel(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
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
                $p_apl_id = $request->has('p_apl_id') ? (int) $request->input('p_apl_id') : 1;
                $p_prf_id = $request->has('p_prf_id') ? (int) $request->input('p_prf_id') : 0;
                $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
                
                //echo "SELECT * FROM seguridad.spu_permisoobjeto_sel($p_apl_id,$p_prf_id,$p_usu_id)";
                $results = DB::select("SELECT * FROM seguridad.spu_permisoobjeto_sel(?,?,?)", [
                    $p_apl_id,$p_prf_id,$p_usu_id
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
    
    public function perfilusuarioapp(Request $request): JsonResponse{
            $validator = Validator::make($request->all(), [
                'p_usu_id' => 'required|integer',
                'p_apl_id' => 'required|integer',
                'p_prf_id' => 'required|integer',
                'p_obj_id' => 'required|integer'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 400);
            }
            
            try {
                $p_usu_id = $request->has('p_usu_id') ? (int) $request->input('p_usu_id') : 0;
                $p_apl_id = $request->has('p_apl_id') ? (int) $request->input('p_apl_id') : 0;
                $p_prf_id = $request->has('p_prf_id') ? (int) $request->input('p_prf_id') : 0;
                $p_obj_id = $request->has('p_obj_id') ? (int) $request->input('p_obj_id') : 0;

                $results = DB::select("SELECT * FROM seguridad.spu_perfilusuario_app(?,?,?,?)", [
                    $p_usu_id,$p_apl_id,$p_prf_id,$p_obj_id
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

}
