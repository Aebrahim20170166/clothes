<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\addRoleRequest;
use App\Http\Requests\Role\updateRoleRequest;
use App\Http\Traits\APIGeneralTrait;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RoleController extends Controller
{
    use APIGeneralTrait;
    public function __construct(private Role $roleModel)
    {
    }

    //endpoint to return all roles
    public function getAllRoles(Request $request)
    {

        $this->checkAdmin($request);
        $roles = $this->roleModel::get();
        return $this->returnData("roles", $roles, "Roles returned successfully");

    }

    public function getPermissions(Request $request)
    {
        $this->checkAdmin($request);

        $permissions = config('trans_ar.premissions');
        return $this->returnData("permissions", $permissions, "Permissions returned successfully");
    }


    public function store(addRoleRequest $request)
    {
        $this->checkAdmin($request);

        $data = [];
        $permissions = config('trans_ar.premissions');
        foreach ($permissions as $key => $permission) {
            array_push($data, $key);
        }
        $permission_ar = [];
        foreach ($request->permissions as $key) {

            if ( array_search($key, $data) ) {
                array_push($permission_ar, $permissions[$key]);
            }
        }
        $permission_ar = json_encode($permission_ar, JSON_UNESCAPED_UNICODE);

        try{
            $this->roleModel::create([
                'name' => $request->name,
                'permissions' => json_encode($request->permissions),
                'permission_ar' => $permission_ar,
            ]);
            return $this->returnSuccess(200, "Role Added Successfully");
        } catch(\Throwable $th){
            return $this->returnError(403, $th->getMessage());
        }

    }

    public function getRole($id, Request $request)
    {
        $this->checkAdmin($request);

        $role = $this->roleModel::findOrFail($id);
        return $this->returnData("data", $role, "data of role");
    }

    public function update(updateRoleRequest $request, $id)
    {
        $this->checkAdmin($request);
        $role = $this->roleModel::find($id);
        if (!$role) {
            return $this->returnError(404, "Role not found");
        }

        $data = [];
        $permissions = config('trans_ar.premissions');
        foreach ($permissions as $key => $permission) {
            array_push($data, $key);
        }

        $permission_ar = [];
        foreach($request->permissions as $key)
        {
            (in_array($key, $data)) ?array_push($permission_ar, $permissions[$key]) : '';
        }
        $permission_ar = json_encode($permission_ar, JSON_UNESCAPED_UNICODE);
        try{
            $role->update([
                'name' => $request->name,
                'permissions' => json_encode($request->permissions),
                'permission_ar' => $permission_ar,
            ]);
        } catch(\Throwable $th) {
            return $this->returnError(403, $th->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        $this->checkAdmin($request);
        
        $role = $this->roleModel::find($id);

        if (!$role)
        {
            return $this->returnError(404, "Role not found");
        }

        $this->roleModel::where('id', $id)->delete();
        return $this->returnSuccess(200, "Role deleted successfully");

    }
}
