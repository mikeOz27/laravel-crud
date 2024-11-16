<?php

namespace App\Http\Controllers;

use App\Classes\FormatResponse;
use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ResetPasswordController extends FormatResponse
{
    public function i_forgot_my_password(Request $request)
    {
        DB::beginTransaction();
        try {
            $email = $request->email;
            $user = User::where('email', $email)->first();
            if ($user) {
                $token = Str::random(120);
                $token_email = new PasswordResetToken();
                $token_email->email = $request->email;
                $token_email->token = $token;
                $token_email->save();

                Mail::send(
                    'emails.reset_password',
                    [
                        'name'  => $user->nickname,
                        'token' => $token
                    ],
                    function ($msj) use($email) {
                        $msj->from(env('MAIL_FROM_ADDRESS'), 'Reset Password');
                        $msj->subject('Restablecimiento de contraseña.');
                        $msj->to($email);
                    }
                );
                DB::commit();
                return $this->toJson($this->estadoExitoso('Correo enviado.'));
            } else {
                return $this->toJson($this->estadoExitoso('El email no se encuentra en nuestra base de datos.'));
            }
        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage() . ' Line: ' . $th->getLine() . ' File: ' . $th->getFile());
            return $this->toJson($this->estadoOperacionFallida("Error del servidor " . $th->getLine() . ".  Intente nuevamente, si el error persiste contacte con soporte."));
        }
    }

    public function validate_data($token, $nickname)
    {
        $user_nickname = User::where('nickname', $nickname)->first();
        if ($user_nickname) {
            $user_token_nickname = User::where('token_email', $token)->first();
            if ($user_token_nickname) {
                if ($user_token_nickname->token_email == null) {
                    return $this->toJson($this->estadoOperacionFallida('Usted ya restableció su contraseña.'));
                } else {
                    return $this->toJson($this->estadoExitoso('OK'));
                }
            } else {
                return $this->toJson($this->estadoOperacionFallida('El token ingresado no es correcto.'));
            }
        } else {
            return $this->toJson($this->estadoNoEncontrado('El email no se encuentra en nuestra base de datos.'));
        }
    }

    public function resend_email(Request $request)
    {
        DB::beginTransaction();
        try {
            $email = $request->email;
            $user = User::where('nickname', $request->nickname)->first();
            if ($user) {
                $token = Str::random(120);
                $token_email = new PasswordResetToken();
                $token_email->email = $request->email;
                $token_email->token = $token;
                $token_email->save();

                Mail::send(
                    'emails.reset_password',
                    [
                        'name'  => $user->nickname,
                        'token' => $token
                    ],
                    function ($msj) use($email) {
                        $msj->from(env('MAIL_FROM_ADDRESS'), 'Reset Password');
                        $msj->subject('Restablecimiento de contraseña.');
                        $msj->to($email);
                    }
                );
                DB::commit();
                return $this->toJson($this->estadoExitoso());
            } else {
                return $this->toJson($this->estadoNoEncontrado('El email no se encuentra en nuestra base de datos.'));
            }
        } catch (Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage() . ' Line: ' . $th->getLine() . ' File: ' . $th->getFile());
            return $this->toJson($this->estadoOperacionFallida("Error del servidor " . $th->getLine() . ".  Intente nuevamente, si el error persiste contacte con soporte."));
        }
    }

    public function reset_password(Request $request)
    {
        $rules = [
            'token'            => 'required|string',
            'password'         => 'required|min:6|string',
            'password_confirm' => 'required|min:6',
        ];

        $messages = [
            'token.required'            => 'El token es requerido.',
            'token.string'              => 'El token no es válido.',
            'password.required'         => 'La contraseña es requerida.',
            'password.min'              => 'La contraseña debe tener al menos 6 caracteres.',
            'password_confirm.required' => 'La confirmación de la contraseña es requerida.',
            'password_confirm.min'      => 'La confirmación de la contraseña debe tener al menos 6 caracteres.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->toJson($this->estadoOperacionFallida($validator->getMessageBag()->all()));
        } else {
            DB::beginTransaction();
            try {
                $token = $request->token;
                $email = $request->email;
                $password = $request->password;

                $user = User::where('email', $email)->first();
                if ($user) {
                    $user->password = Hash::make($password);
                    $user->save();

                    $user_email = PasswordResetToken::where('token', $token)
                                                    ->where('email', $email)
                                                    ->first();
                    Mail::send(
                        'emails.reset_password_change',
                        [
                            'name' => $user->nickname

                        ],
                        function ($msj) use ($user_email) {
                            $msj->from(env('MAIL_FROM_ADDRESS'), 'Test recovery password');
                            $msj->subject('Restablecimiento de contraseña exitoso.');
                            $msj->to($user_email->email);
                        }
                    );
                    DB::commit();
                    return $this->toJson($this->estadoExitoso('Cambio de contraseña exitoso.'));
                }
                return $this->toJson($this->estadoNoEncontrado('El email o token no son los correctos.'));
            } catch (Throwable $th) {
                DB::rollback();
                Log::error($th->getMessage() . ' Line: ' . $th->getLine() . ' File: ' . $th->getFile());
                return $this->toJson($this->estadoOperacionFallida("Error del servidor " . $th->getLine() . ".  Intente nuevamente, si el error persiste contacte con soporte."));
            }
        }
    }
}
