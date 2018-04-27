<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * 角色列表
     * get:/roles
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View\
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', [
            'roles'=>$roles
        ]);
    }

    /**
     * 添加角色
     * get:/roles/create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * 添加角色
     * post:/roles
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Role::create($request->except('_token'));
        return redirect()->route('adminRoleIndex');
    }

    /**
     * 删除角色信息
     * delete:/roles/{id}
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('adminRoleIndex');
    }

    /**
     * 分配权限表单
     * get:/roles/{id}/editpermission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPermission($id)
    {
        $permissions = Permission::all();
        $role_permissions = RolePermission::where('role_id', $id)->get();
        foreach ($permissions as $permission) {
            foreach ($role_permissions as $role_permission) {
                if ($permission->id === $role_permission->permission_id) {
                    $permission->checked = true;
                }
            }
        }
        return view('admin.role.editpermission', [
            'permissions'=> $permissions,
            'id'=>$id
        ]);
    }

    /**
     * 更新角色的权限
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermission(Request $request, $id)
    {
        $permissions = $request->except('_token');
        Role::find($id)->updatePermission($permissions);
        return redirect()->route('adminRoleEditPermission', ['id'=>$id]);
    }
}
