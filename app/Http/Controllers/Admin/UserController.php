<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Mail\RequestUser;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    //Visualizar usuarios
    public function index(Request $request)
    {
        $users = new User();
        $requests = $users;
        if (isset($request->request) && !empty($request->request))
        {
            $keysR = array("name");//Campos validos para búsqueda
            foreach ($request->request as $keyR => $valueR)
            {
                if ($valueR=="0")
                    $valueR = "cero";
                if (in_array($keyR, $keysR) && $valueR)
                {
                    if ($valueR=="cero")
                        $valueR = "0";
                    if ($keyR=="name")
                    {
                        /*$users = $users->filter(function($users) use ($keyR, $valueR) {
                            return str_contains($users->$keyR, $valueR);//https://laravel.com/docs/5.2/helpers
                        });*/
                        $users = $users->where($keyR, 'like', '%'.strval($valueR).'%');
                    }
                    else
                        $users = $users->where($keyR, $valueR);
                    $requests->{$keyR."Filter"} = $valueR;
                }
            }
        }
        if (isset($_GET['page']))
            $page = $_GET['page'];
        else
            $page = 1;
        $users = $users->get();
        $users = paginateAdd($users, 20, $page)->setPath(route('admin.user'));
        return view('admin.user.index', compact('users', 'requests'));
    }

    //Crear usuarios
    public function save(UserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $password = generateString(15);
        $user->password = bcrypt($password);
        $user->created_user = Auth::id();
        if ($user->save())
        {
            alert()->success(__('Se ha creado el usuario'))->confirmButton();
            Mail::send(new RequestUser($password, $user->email));
        }
        else
            alert()->error(__('Error al crear el usuario'))->confirmButton();
        return redirect(route('admin.user'));
    }

    //Formulario editar usuarios
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    //Editar usuarios
    public function update(UserRequest $request)
    {
        $user = User::find($request->id);
        $user->fill($request->all());
        $user->updated_user = Auth::id();
        if ($user->save())
            alert()->success(__('Se ha modificado el usuario'))->confirmButton();
        else
            alert()->error('Error al crear el usuario')->confirmButton();
        return redirect(route('admin.user'));
    }

    public function delete(User $user)
    {
        $userUser = $user->email;
        $user->email = $userUser.";deleted_at:".date("Y-m-d_H:i:s");//Se cambia el usuario para que en caso de que se vaya a crear uno con este mismo no presente inconvenientes
        $userD = User::find($user->id);
        $userD->timestamps = false;//Para que no modifique el updated_at
        if ($userD->delete())
        {
            $user->deleted_user = Auth::id();
            $user->timestamps = false;//Para que no modifique el updated_at
            if ($user->save())
                alert()->success(__('Se ha eliminado el usuario'))->confirmButton();
            else
                alert()->error(__('Error al eliminar el usuario'))->confirmButton();
        }
        else
            alert()->error(__('Error al eliminar el usuario'))->confirmButton();
        return redirect(route('admin.user'));
    }
}
