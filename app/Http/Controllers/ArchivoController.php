<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ArchivoController extends Controller
{    
    public function archivossel(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_arc_id' => 'required|integer',
            'p_tkt_id' => 'required|integer',
            'p_rut_id' => 'required|integer',
            'p_arc_activo' => 'required|integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ], 400);
        }
        
        try {
            $p_arc_id = $request->has('p_arc_id') ? (int) $request->input('p_arc_id') : 0;
            $p_tkt_id = $request->has('p_tkt_id') ? (int) $request->input('p_tkt_id') : 0;
            $p_rut_id = $request->has('p_rut_id') ? (int) $request->input('p_rut_id') : 0;
            $p_arc_activo = $request->has('p_arc_activo') ? (int) $request->input('p_arc_activo') : 1;

            $results = DB::select("SELECT * FROM tickets.spu_archivos_sel(?,?,?,?)", [
                $p_arc_id,$p_tkt_id,$p_rut_id,$p_arc_activo
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
    
    public function archivosanu(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            'p_arc_id' => 'required|integer',
            'p_arc_usumov' => 'required|integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ], 400);
        }
        
        try {
            $p_arc_id = $request->has('p_arc_id') ? (int) $request->input('p_arc_id') : 0;
            $p_arc_usumov = $request->has('p_arc_usumov') ? (int) $request->input('p_arc_usumov') : 0;

            $results = DB::select("SELECT * FROM tickets.spu_archivos_anu(?,?)", [
                $p_arc_id,$p_arc_usumov
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
