<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRol;
use Illuminate\Http\Request;
use App\Classes\FormatResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends FormatResponse
{
    public function getUsers(){
        $users = User::join('user_roles', 'users.id','user_roles.user_id')
            ->join('roles', 'user_roles.role_id', 'roles.id')
            ->get([
                'users.*',
                'roles.name as rol',
                'roles.id as role_id'
            ]);
        return $this->estadoExitoso($users);
    }

    public function countUsers(){
        $users = User::count();
        return $this->estadoExitoso($users);
    }

    public function desactivateUser($id){
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return $this->estadoExitoso($user);
    }

    public function activateUser($id){
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return $this->toJson($this->estadoExitoso($user));
    }

    function generarNicknameAleatorio($name) {
        $prefijos = [$name . '_'];
        $sufijo = rand(1000, 9999); // Número aleatorio de 4 dígitos
        $letras = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 3);

        // Selecciona un prefijo aleatorio
        $prefijo = $prefijos[array_rand($prefijos)];

        // Concatena el prefijo, las letras y el número aleatorio
        return $prefijo . $letras . $sufijo;
    }


    public function register_user() {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->toJson($this->estadoOperacionFallida($validator->errors()));
        }

        DB::beginTransaction();
        try {
            if(request()->file('image')){
                $path = request()->file('image');
                $path = Storage::disk('public')->put('images', $path);
                $storage = Storage::url($path);
                $url = env('APP_URL_IMAGE') . $storage;
            }
            $user = new User;
            $name = request()->name;
            $user->name = $name;
            $user->email = request()->email;
            $user->nickname = $this->generarNicknameAleatorio($name);
            $user->image = $url ?? 'https://ui-avatars.com/api/?name='. request()->name;
            $user->status = 1;
            $user->password = bcrypt(request()->password);
            if($user->save()){
                $user_rol = new UserRol;
                $user_rol->user_id = $user->id;
                $user_rol->role_id = 2;
                $user_rol->save();

                DB::commit();

                $user = User::join('user_roles', 'users.id', 'user_roles.user_id')
                    ->join('roles', 'user_roles.role_id', 'roles.id')
                    ->where('users.id', $user->id)
                    ->select('users.*',  'roles.name as role', 'roles.id as role_id')
                    ->first();
            }
            return $this->toJson($this->estadoExitoso($user));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toJson($this->estadoOperacionFallida($th->getMessage()));
        }

        return $this->toJson($this->estadoExitoso($user));
    }

    public function update() {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => ['required', 'email',  Rule::unique('users')->ignore(request()->id)],
        ]);

        if($validator->fails()){
            return $this->toJson($this->estadoOperacionFallida($validator->errors()));
        }

        $user = User::find(request()->id);
        $user->fill(request()->all());
        $user->save();

        return $this->toJson($this->estadoExitoso($user));
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return $this->toJson($this->estadoExitoso($user));
    }
}
