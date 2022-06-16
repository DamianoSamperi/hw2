<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Label;
use App\Models\Utente;
use Illuminate\Support\Facades\Session;
class PreferitoController extends Controller {
    public function verifica($preferito,$id){
        $username=session('username');
        $exist = Label::where('username', $username)->where('label',$id)->exists();
        if($exist){
            $entry= true ;
        }else
        {
        $entry=false;
        }
        return json_encode($array = ['entry' => $entry, 'preferito' => $preferito]);
        }
    public function modifica($preferito,$id){
        $user=session('user_id');
        $username=session('username');
        $exist = Label::where('user_id', $user)->where('label',$id)->exists();
        if($exist){
            Label::where('label',$id)->delete();
            $entry =true;
        }else{
            $exist = Utente::where('username', $username)->exists();
            if($exist){
                $newUser =  Label::create([
                    'label' => $id,
                    'username' => $username,
                    'user_id' => $user,
                    ]);
                    $entry =false;
            }
        }
        return json_encode($array = ['entry' => $entry, 'preferito' => $preferito]);
    }
      }


?>