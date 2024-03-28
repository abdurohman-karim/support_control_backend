<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        is_forbidden("Просмотр разрешений");
        $permissions = Permission::with('roles')->orderByDesc('id')->paginate(25);
        return view('pages.permission.index',compact('permissions'));
    }

    public function create()
    {
        return view('pages.permission.create');
    }

    public function store(Request $request)
    {
        is_forbidden("Добавить разрешение");
        $this->validate($request,[
            'name' => 'required|unique:permissions'
        ]);

        Permission::create($request->all());
        message_set("Добавлено новое разрешение!",'success');
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        is_forbidden("Изменить разрешение");
        return view('pages.permission.edit',compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->validate($request,[
            'name' => "required|unique:permissions,name,$permission->id"
        ]);

        $permission->name = $request->name;
        $permission->save();

        message_set('Новые данные сохранены!','success');
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        is_forbidden("Удалить разрешение");
        $permission->delete();
        LogWriter::deleteActivity($permission,'Permission');
        message_set("Удалено!",'success');
        return redirect()->back();
    }
}
