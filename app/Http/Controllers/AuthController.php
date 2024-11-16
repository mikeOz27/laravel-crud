<?php

namespace App\Http\Controllers;

use App\Models\User;
use Mailgun\Mailgun;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Classes\FormatResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;


class AuthController extends FormatResponse
{

    public function validateToken()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }

            // Si el token es válido, retorna una respuesta positiva
            return response()->json([
                'code' => 200,
                'message' => 'Token válido', 'user' => $user
            ], 200);
        } catch (JWTException $e) {
            // Si el token ha expirado o es inválido
            return response()->json([
                'code' => 401,
                'message' => 'Token inválido o expirado'
            ], 401);
        }
    }

    function generarNicknameAleatorio() {
        $prefijos = ['User'];
        $sufijo = rand(1000, 9999); // Número aleatorio de 4 dígitos
        $letras = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 3);

        // Selecciona un prefijo aleatorio
        $prefijo = $prefijos[array_rand($prefijos)];

        // Concatena el prefijo, las letras y el número aleatorio
        return $prefijo . $letras . $sufijo;
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register() {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()){
            return $this->toJson($this->estadoOperacionFallida($validator->errors()));
        }

        $user = new User;
        $user->name = request()->name;
        $user->email = request()->email;
        $user->nickname = $this->generarNicknameAleatorio();
        $user->image = 'https://ui-avatars.com/api/?name='.request()->name;
        $user->password = bcrypt(request()->password);
        $user->save();

        return $this->toJson($this->estadoExitoso($user));
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $messages = [
            'email.required' => 'El Email es requerido.',
            'password.required' => 'La Contraseña es requerida.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->errors()->getMessages()) {
            return $this->toJson($this->estadoOperacionFallida($validator->getMessageBag()->all()));
        } else {
            try {
                $credentials = request(['email', 'password']);
                // dd($request->email);
                if (! $token = auth()->attempt($credentials)) {
                    return $this->toJson($this->estadoOperacionFallida('Las credenciales no son correctas'));
                }

                $user = User::where('email', $request->email)->first();
                $date_expires = now()->addMinutes(config('jwt.ttl')); // TIEMPO DE TOKEN 1 HORA
                $timeExpire = $date_expires;
                $mensaje = "Procesado con éxito";
                $response = [
                    'code'         => 200,
                    'message'      => $mensaje,
                    'token'        => $token,
                    'expires_at'   => Carbon::parse($timeExpire)->diffForHumans(),
                    'date_expires' => Carbon::parse($date_expires)->toDateTimeString(),
                    'token_type'   => 'bearer',
                    'user'         => $user
                ];


                return $response = [
                    'status' => $response
                ];
            } catch (\Throwable $th) {
                DB::error($th);
                return $this->toJson($this->estadoOperacionFallida());
            }
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            // Intenta obtener el token del header
            $user = JWTAuth::parseToken()->authenticate();

            if ($user) {
                return $this->respondWithToken(auth()->refresh());
            } else {
                return response()->json([
                    'code' => 401,
                    'message' => 'Token inválido'
                ], 401);
            }
        } catch (TokenBlacklistedException $e) {
            // Manejo del token blacklisted
            return response()->json([
                'code' => 401,
                'message' => 'El token ha sido revocado o está en la lista negra. Por favor, inicia sesión nuevamente.'
            ], 401);
        } catch (\Exception $e) {
            // Otros errores generales de JWT
            return response()->json([
                'status' => 'error',
                'message' => 'Token inválido o expirado.'
            ], 401);
        }

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
