<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\User;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $entrada = $request->only('email', 'password');
        $token = null;
        if (!$token = JWTAuth::attempt($entrada)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales Invalidas'
            ], 401);
        }
        $response = compact('token');
        $response['user'] = Auth::user();
        return response()->json([
            'success' => true,
            'data' =>  $response
        ], 200);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'Session finalizada Exitosamente'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Lo setimos no pudes cerrar sesion'
            ], 500);
        }
    }
    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {
        try {
            $data =  User::where('email', $request->email)->exists();
            if ($data){

                return response()->json([
                    'success'   =>  false,
                    'data'      =>  $request->email,
                    'message' => 'El email que intenta crear ya existe'
                ], 400);

            } else {

                $request['password'] = bcrypt($request->password);
                $user =  User::create($request->all());

                if ($user) {

                    return response()->json([
                        'success'   =>  true,
                        'data'      =>  $user
                    ], 200);

                }else{

                    return response()->json([
                    'success'   =>  false,
                    'data'      =>  $request->email,
                    'message' => 'Error al crear crear el Usuario'
                ], 400);

                }
               
            }
        } catch (\Throwable $th) {
            return $e->getMessage(); 
        }
    }
}
