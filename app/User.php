<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 更新用户的角色信息
     * @param array $roles 数组，所有的角色id数据
     * @return bool 是否更新成功
     */
    public function updateRole(array $roles)
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
