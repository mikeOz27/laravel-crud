<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Classes\FormatResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends FormatResponse
{
    public function getUsers(){
        $users = User::all();
        return $this->toJson($this->estadoExitoso($users));
    }

    public function desactivateUser($id){
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return $this->toJson($this->estadoExitoso($user));
    }

    public function activateUser($id){
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return $this->toJson($this->estadoExitoso($user));
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
        $user->nickname = request()->name;
        $user->email = request()->email;
        $user->nickname = $this->generarNicknameAleatorio();
        $user->images = 'https://ui-avatars.com/api/?name='.request()->name;
        $user->password = bcrypt(request()->password);
        $user->save();

        return $this->toJson($this->estadoExitoso($user));
    }

    public function update() {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            //validar que sea el mismo usuario
            'email' => ['required', 'email',  Rule::unique('users')->ignore(request()->id)],
            'password' => 'required|min:6',
        ]);

        if($validator->fails()){
            return $this->toJson($this->estadoOperacionFallida($validator->errors()));
        }

        $user = User::find(request()->id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->save();

        return $this->toJson($this->estadoExitoso($user));
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return $this->toJson($this->estadoExitoso($user));
    }
}
