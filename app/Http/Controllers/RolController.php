<?php

namespace App\Http\Controllers;

use App\Classes\FormatResponse;
use App\Models\Role;
use Illuminate\Http\Request;

class RolController extends FormatResponse
{
    /**
     * Display a listing of the resource.
     */
    public function get_roles_home()
    {
        $roles = Role::all();
        return $this->toJson($this->estadoExitoso($roles));
    }

    public function get_roles()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function create_role()
    {
        $role = Role::create(request()->all());
        return response()->json($role);
    }

    public function update_role($id)
    {
        $role = Role::find($id);
        $role->update(request()->all());
        return response()->json($role);
    }

    public function delete_role($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json('deleted');
    }

    public function countRoles()
    {
        $roles = Role::count();
        return $this->estadoExitoso($roles);
    }
}
