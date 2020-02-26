<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class chkLoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        } else {
            return view('auth.login');
        }
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin');
        } else {
            return redirect()->route('getLogin')->with(['flash_message_title' => 'Login Fail', 'flash_message_content' => 'Email or Password not correct. Please try again!']);
        }
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'user';
            $user->save();
            return redirect()->route('getLogin')->with(['flash_message_type' => 'success', 'flash_message_title' => 'Success', 'flash_message_content' => 'Success!!! Register success. Please login to continue.']);
        } catch (Exception $e) {
            return redirect()->route('getRegister')->with(['flash_message_type' => 'danger', 'flash_message_title' => 'Fail', 'flash_message_content' => 'Fail!!! Register fail. Please try again.']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

}
