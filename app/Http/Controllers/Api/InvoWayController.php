<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MiProveedor\log10KeyLogerAPi;

class InvoWayController extends Controller
{

    public function getDataUser(Request $request)
    {
        try {
            //URLS: http://integracion.local/api/invoway/user/token; http://cip.parservicios.com/api/invoway/user/token
            //POST; Authorization: bearer token y en el campo token se deja el que retorna la funcion login; Body: form data y se envia token
            if (isset($request->token) && $request->token)
            {
                $token = log10KeyLogerAPi::select('log10_key_user', 'sys4_role_name')->where('log10_api', 'Invo Way')->where('log10_key_loger', $request->token)->first();
                if ($token!=null && !empty($token) && isset($token->log10_key_user))
                {
                    $user = $token->user;
                    if ($user && $user->lg1_id)
                    {
                        $info = array();
                        $info['usuario'] = $user->lg1_user;
                        $info['nombre'] = $user->lg1_userName;
                        $info['rol'] = $token->sys4_role_name;
                        $info['email'] = $user->lg1_email;
                        return response()->json($info, 202);
                    }
                }
                return response()->json(['msg' => 'No existe usuario'], 202);
            }
            return response()->json(['msg' => 'No existe token'], 202);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Error en el proceso'], 202);
        }
        return response()->json(['msg' => 'Acceso no autorizado'], 202);
    }
}
