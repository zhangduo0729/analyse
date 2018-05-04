<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 用于添加或者修改的字段验证
     * @param array $data 用户数据
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    /**
     * 用户列表
     * get:/users
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', [
            'users'=> $users
        ]);
    }

    /**
     * 添加用户表单页面
     * get:/users/create
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * 添加用户
     * post:/users
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = $request->except('_token');
        $user['password'] = bcrypt($user['password']);
        User::create($user);
        return redirect()->route('adminUserIndex');
    }

    /**
     * 删除用户
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('adminUserIndex');
    }

    /**
     * 编辑用户角色表单
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editRole($id)
    {
        $roles = Role::all();
        $user_roles = UserRole::where('user_id', $id)->get();
        foreach ($roles as $role) {
            foreach ($user_roles as $user_role) {
                if ($user_role->role_id == $role->id) {
                    $role->checked = true;
                    break;
                }
            }
        }
        return view('admin.user.editrole', [
            'roles'=>$roles,
            'user_id'=>$id
        ]);
    }

    /**
     * 更新用户角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole(Request $request, $id)
    {
        $roles = $request->except('_token');
        User::find($id)->updateRole($roles);
        return redirect()->route('adminUserEditRole', ['id'=>$id]);
    }
}
