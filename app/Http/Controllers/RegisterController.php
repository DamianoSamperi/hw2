<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\Utente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use App\Http\Request\StoreNoteRequest;


class RegisterController extends Controller{
      protected function register(){
            $request=request()->all();
            if($this->countErrors($request) === 0) {
                $password_hashed=bcrypt($request['password']);
                $newUser =  Utente::create([
                'username' => $request['username'],
                'password' => $password_hashed,
                'cellulare' => $request['cellulare'],
                'email' => $request['email'],
                ]);
                if ($newUser) {
                    Session::put('user_id', $newUser->id);
                    Session::put('username',$newUser->username);
                    return redirect('home');
                } 
                else {
                    return redirect('/register/index')->withInput();
                }
      }else 
      return redirect('/register/index')->withInput();
      
    }
      private function countErrors($data) {
        $error = array();
        
        # USERNAME
        // Controlla che l'username rispetti il pattern specificato
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $data['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = Utente::where('username', $data['username'])->first();
            if ($username !== null) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD
        if (strlen($data["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        }
        # CELLULARE
        if(!preg_match('/^[0-9]{10,10}$/',$data['cellulare'])){
            $error[]="cellulare non valido";
        }else{
            $cellulare = Utente::where('cellulare', $data['cellulare'])->first();
            if ($cellulare !== null) {
                $error[] = "Numero già utilizzata";
            }
        } 
        # EMAIL
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = Utente::where('email', $data['email'])->first();
            if ($email !== null) {
                $error[] = "Email già utilizzata";
            }
        }

        return count($error);
    }
    public function checkUsername($query) {
        $exist = Utente::where('username', $query)->exists();
        return [$exist];
    }

    public function checkEmail($query) {
        $exist = Utente::where('email', $query)->exists();
        return [$exist];
    }
    public function checkCellulare($query) {
        $exist = Utente::where('cellulare', $query)->exists();
        return [$exist];
    }
    public function index(){
        return view('register');
    }
}

?>