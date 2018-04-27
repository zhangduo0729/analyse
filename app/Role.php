<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function updatePermission(array $permissions)
    {
        $role_id = $this->id;
        $role_permissions = RolePermission::where('role_id', $role_id)->get();
        DB::beginTransaction();
        try {
            foreach ($role_permissions as $role_permission) {
                if (!in_array($role_permission->role_id, $permissions)) {
                    RolePermission::destroy($role_permission->id);
                }
            }
            foreach ($permissions as $permission_id) {
                $in = false;
                foreach ($role_permissions as $role_permission) {
                    if ($permission_id === $role_permission->id) {
                        $in = true;
                        break;
                    }
                }
                if (!$in) {
                    RolePermission::create([
                        'role_id'=>$role_id,
                        'permission_id'=>$permission_id[0]
                    ]);
                }
            }
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }
}
