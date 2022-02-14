<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        //NOTA: Se cambia en .env DB_DATABASE a DB_DATABASE2 ya que genera error de conexión de base
        //POST;
        //http://integracion.local/api/login?email=&password=
        //https://cip.parservicios.com/api/login?email=j&password=
        // si genera error oauth-private.key does not exist or is not readable ejecutar php artisan passport:install
        try
        {
            $request = $request->input();
            if (Auth::attempt($request))
            {
                $user = Auth::user();
                $success['token'] = $user->createToken(Auth::id())->accessToken;
                return response()->json($success, 202);
            }
            return response()->json(['error' => 'acceso no autorizado'], 401);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    /**
     * Me permite conocer si el token que estoy recibiendo es valido
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateToken()
    {
        return response()->json(['msg' => 'token valido'], 202);//GET;Authorization: bearer token y en el campo token se deja el que retorna la funcion login;http://integracion.local/api/validate/token
    }

    public function create(Request $request)
    {
        //NOTA: Se cambia en .env DB_DATABASE a DB_DATABASE2 ya que genera error de conexión de base
        //POST;
        //http://integracion.local/api/login?email=&password=
        //https://cip.parservicios.com/api/login?email=j&password=
        try
        {
            if (isset($request->cl1_name) && isset($request->cl1_identification) && isset($request->cl1_email) && str_replace(" ", "", $request->cl1_name)!="" && str_replace(" ", "", $request->cl1_identification)!="" && str_replace(" ", "", $request->cl1_email)!="")
            {
                $dataUser = User::whereEmail($request->cl1_email)->count();
                if ($dataUser>0)
                    return response()->json(['msg' => __('Correo ya existente')], 202);
                else
                {
                    $user = new User();
                    $user->name = $request->cl1_name;
                    $user->email = $request->cl1_email;
                    $user->password = bcrypt($request->cl1_identification);
                    $user->created_user = 11;
                    if ($user->save())
                        return response()->json(['msg' => __('Se ha creado el usuario')], 202);
                    else
                        return response()->json(['msg' => __('Error al crear el usuario')], 202);
                }
            }
            return response()->json(['msg' => 'Error al obtener la información'], 202);
        }
        catch (\Exception $e)
        {
            return response()->json(['msg' => $e->getMessage()], 202);
        }
    }

    public function validateUser(Request $request)
    {
        //NOTA: Se cambia en .env DB_DATABASE a DB_DATABASE2 ya que genera error de conexión de base
        //POST;
        //http://integracion.local/api/login?email=&password=
        //https://cip.parservicios.com/api/login?email=j&password=
        try
        {
            if (isset($request->cl1_name) && isset($request->cl1_email) && str_replace(" ", "", $request->cl1_name)!="" && str_replace(" ", "", $request->cl1_email)!="")
                return response()->json(['msg' => User::whereEmail($request->cl1_email)->whereName($request->cl1_name)->count()], 202);
            return response()->json(['msg' => 'Error al obtener la información'], 202);
        }
        catch (\Exception $e)
        {
            return response()->json(['msg' => $e->getMessage()], 202);
        }
    }
}
