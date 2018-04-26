<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function updatePermission(array $permissions)
    {
        $user_id = $this->id;
        $user_roles = UserRole::where('user_id', $user_id)->get();
        DB::beginTransaction();
        try {
            foreach ($user_roles as $user_role) {
                if (!in_array($user_role->role_id, $roles)) {
                    UserRole::destroy($user_role->id);
                }
            }
            foreach ($roles as $role_id) {
                $in = false;
                foreach ($user_roles as $user_role) {
                    if ($role_id === $user_role->id) {
                        $in = true;
                        break;
                    }
                }
                if (!$in) {
                    UserRole::create([
                        'user_id'=>$user_id,
                        'role_id'=>$role_id[0]
                    ]);
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }
}
