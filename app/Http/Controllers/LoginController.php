<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Utente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {
    public function login() {
        if(session('user_id') != null) {
            return redirect("home");
    } else {
        return view('login')
        ->with('csrf_token', csrf_token());
    }}
    
    public function checkLogin() {
        if(password_verify(request('password'),Utente::where('username', request('username'))->pluck('password')->first()))
        $verify=true;
        else
        $verify=false;
        $user = Utente::where('username', request('username'))->first();
   
        if($user !== null&&$verify) {
            Session::put('user_id', $user->id);
            Session::put('username', $user->username);
            return redirect('home');
        }
        else {
            return redirect('/')->withInput();
        }
    }
    public function logout() {
        Session::flush();
        return redirect('/');
    }    

}
?>