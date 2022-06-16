<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Utente;
use App\Models\Descrizione;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller{
    public function index() {
        if(session('user_id') != null) {
            $session=session('username');
            return view("home")->with('user',$session);
            
    } else {
        return view('login')
        ->with('csrf_token', csrf_token());
    }}
    public function store()
    {
        $request=request()->all();
        $username=session('username');
        $descrizione = new Descrizione();
        $descrizione->testo = $request['descrizione'];
        $descrizione->username = $username;      
        $descrizione->save();
         return redirect('home')->withInput();
    }

}
?>