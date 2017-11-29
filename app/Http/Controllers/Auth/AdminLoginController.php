<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $data)
    {
        # validacion de los campos de login
        $this->validate($data, [
          'email'     => 'required|email',
          'password'  => 'required|min:6'
        ]);

        # Se intenta loguear, en caso de retornar true se redirige al dashboard del admin
        if(Auth::guard('admin')->attempt(['email' => $data->email, 'password' => $data->password], $data->remember)){
            return redirect()->intended(route('admin/admin.dashboard'));
        }

        # Si fallo la autentificacion, se devuelve a la pagina de login, manteniendo el usuario y el checkbox remember
        return redirect()->back()->withInput($data->only('email', 'remember'));
    }
}
