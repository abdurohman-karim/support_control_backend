<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        is_forbidden("Посмотреть роли");
        $roles = Role::with('permissions')->paginate(25);
        return view('pages.role.index', compact('roles'));
    }


    public function create()
    {
        is_forbidden("Создать новую роль");
        $permissions = Permission::all();
        return view('pages.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        if ($request->has('permissions'))
            foreach ($request->permissions as $item) {
                $role->givePermissionTo($item);
            }
        message_set('Создана новая роль!','success');
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        is_forbidden("Изменить роль");
        $permissions = Permission::all();
        return view('pages.role.edit',compact('role','permissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => "required|unique:roles,name,$role->id"
        ]);

        $role->name = $request->name;

        if ($role->isDirty()) $role->save();
        if ($request->has('permissions'))
            $role->syncPermissions($request->permissions);
        else
            $role->syncPermissions([]);

        message_set('Роль обновлена!','success');
        return redirect()->route('roles.index');
    }


    public function destroy(Role $role)
    {
        is_forbidden("Удалить роли");
        $role->delete();
        message_set('Роль удалена!','success');
        LogWriter::deleteActivity($role, 'Role');
        return redirect()->back();
    }
}
