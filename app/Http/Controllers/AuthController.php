<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }

    public function login(Request $request)
    {
        $p_loging =  $request->has('p_loging') ? (string) $request->input('p_loging') : '';
        $p_passwd =  $request->has('p_passwd') ? (string) $request->input('p_passwd') : '';
        $apl_id = 4;

        try {
            $result = DB::select("SELECT * FROM seguridad.spu_acceso_chk(?, ?, ?)",[
                $p_loging
                , $p_passwd
                , $apl_id]);

            if (empty($result)) {
                return response()->json(['error' => 'Error al procesar autenticación.'], 500);
            }

            $response = (array) $result[0];

            if ((int)$response['error'] !== 0) {
                return response()->json([
                    'error' => 'Acceso denegado',
                    'codigo' => $response['error'],
                    'mensaje' => $response['mensa']
                ], 401);
            }

            $user = new \App\Models\User([
                'id' => 1
            ]);
            
            $token = JWTAuth::fromUser($user);
            
            return response()->json([
                'token' => $token,
                'user' => [
                    'id' => $response['numid']
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error interno',
                'mensaje' => $e->getMessage(),
            ], 500);
        }
    }

    public function cambiarclave(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            $p_usu_id =  $request->has('p_usu_id') ? (string) $request->input('p_usu_id') : '';
            $p_usu_pasold =  $request->has('p_usu_pasold') ? (string) $request->input('p_usu_pasold') : '';
            $p_usu_pasnew =  $request->has('p_usu_pasnew') ? (string) $request->input('p_usu_pasnew') : '';

            $result = DB::select('SELECT * FROM seguridad.spu_usuarioclave_chg(?, ?, ?)',[
                $p_usu_id
                , $p_usu_pasold
                , $p_usu_pasnew]);

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

    public function userProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_usu_id' => 'required|integer',
            'p_usu_activo' => 'required|integer',
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
            $p_usu_apepat = $request->has('p_usu_apepat') ? (string) $request->input('p_usu_apepat') : '';
            $p_usu_apemat = $request->has('p_usu_apemat') ? (string) $request->input('p_usu_apemat') : '';
            $p_usu_nombre = $request->has('p_usu_nombre') ? (string) $request->input('p_usu_nombre') : '';
            $p_usu_loging = $request->has('p_usu_loging') ? (string) $request->input('p_usu_loging') : '';
            $p_usu_chkadm = $request->has('p_usu_chkadm') ? (int) $request->input('p_usu_chkadm') : 9;
            $p_usu_activo = $request->has('p_usu_activo') ? (int) $request->input('p_usu_activo') : 9;

            //echo "SELECT * FROM tickets.spu_usuario_age($p_usu_id, '$p_usu_apepat', '$p_usu_apemat', '$p_usu_nombre', '$p_usu_loging', $p_usu_chkadm, $p_usu_activo)";

            $results = DB::select("SELECT * FROM tickets.spu_usuario_age(?,?,?,?,?,?,?)", [
                $p_usu_id
                , $p_usu_apepat
                , $p_usu_apemat
                , $p_usu_nombre
                , $p_usu_loging
                , $p_usu_chkadm
                , $p_usu_activo]);
            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los datos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada']);
    }
}
