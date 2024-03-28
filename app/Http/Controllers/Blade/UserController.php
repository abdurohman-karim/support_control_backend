<?php

namespace App\Http\Controllers\Blade;

use App\Models\User;
use App\Services\LogWriter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        is_forbidden('Просмотр пользователей');
        $users = User::deepFilters()
            ->orderByDesc('id')
            ->with('roles')
            ->paginate();

        return view('pages.users.index',compact('users'));
    }

    public function create()
    {
        is_forbidden('Создать пользователя');
        $roles = Role::all();
        return view('pages.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        is_forbidden('Создать пользователя');
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users','max:12'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = new User();
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        if (is_user_can('Установить роль для пользователя') && $request->has('roles'))
        {
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }
        }
        LogWriter::createUser($user);
        message_set("Создан новый пользователь с именем $user->name!",'success');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if (auth()->id() != $id)
            is_forbidden("Изменить пользователя");

        $roles = Role::all();
        $user = User::whereId($id)->with('roles')->firstOrFail();
        $user->roles = array_flip($user->roles->map(function ($role){
            return $role->name;
        })->toArray());

        return view('pages.users.edit',compact('user','roles'));
    }


    public function update(Request $request, User $user)
    {
        if ($request->has('phone')){
            $request->merge(['phone' => substr((int)filter_var($request->get('phone'), FILTER_SANITIZE_NUMBER_INT),-9)]);
        }

        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$user->id"],
            'phone' => ['required', 'min:9','string',"unique:users,phone,$user->id"],
            'password' => ['string', 'nullable','min:6'],
        ]);

        $roles = $user->roles;
        $old = $user;
        $user->fill($request->all());

        if (isset($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if (is_user_can("Установить роль для пользователя")){
            if (isset($request->roles))
                $user->syncRoles($request->get('roles'));
            else
                $user->syncRoles([]);
        }
        message_set("Данные обновлены",'info');
        LogWriter::updateUser($old,$user);
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        is_forbidden("Удалить пользователя");
        LogWriter::deleteUser($user);
        $user->delete();
        message_set("Пользователь удален!",'success');
        return redirect()->back();
    }
}
