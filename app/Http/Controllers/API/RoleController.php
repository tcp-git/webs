<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return request()->user()->organization_id;
        $role = Role::all();
        if (!$role) {
            return $this->returnErrorResponse(404, 'Role Not Found', 'ROLE_NOT_FOUND');
        }
        return $this->returnDataResponse($role);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->input('name');

        if (!$role->save()) {
            return $this->returnErrorResponse(404, 'Role Not Found', 'ROLE_NOT_FOUND');
        }
        return $this->returnDataResponse($role);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->returnErrorResponse(404, 'Role Not Found', 'ROLE_NOT_FOUND');
        }
        return $this->returnDataResponse($role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->updated_user_id = $request->updated_user_id;
        if (!$role->save()) {
            return $this->returnErrorResponse(404, 'Role Not Found', 'ROLE_NOT_FOUND');
        }
        return $this->returnDataResponse($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if (!$role->delete()) {
            return $this->returnErrorResponse(404, 'Role Not Delete', 'ROLE_NOT_DELETE');
        }
        return $this->returnDataResponse($role);
    }
}
