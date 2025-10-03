<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AreaController extends Controller
{    
    public function areadenominacionsel(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_ard_id' => 'required|integer',
            'p_acl_id' => 'required|integer',
            'p_arj_id' => 'required|integer',
            'p_atd_id' => 'required|integer',
            'p_ard_activo' => 'required|integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ], 400);
        }
        
        try {
            $p_ard_id = $request->has('p_ard_id') ? (int) $request->input('p_ard_id') : 0;
            $p_acl_id = $request->has('p_acl_id') ? (int) $request->input('p_acl_id') : 0;
            $p_arj_id = $request->has('p_arj_id') ? (int) $request->input('p_arj_id') : 0;
            $p_atd_id = $request->has('p_atd_id') ? (int) $request->input('p_atd_id') : 0;
            $p_ard_activo = $request->has('p_ard_activo') ? (int) $request->input('p_ard_activo') : 1;

            $results = DB::select("SELECT * FROM area.spu_areadenominacion_sel(?,?,?,?,?)",
            [
                $p_ard_id
                , $p_acl_id
                , $p_arj_id
                , $p_atd_id
                , $p_ard_activo
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
