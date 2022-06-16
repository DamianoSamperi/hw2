<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Utente;
use App\Models\Label;
use App\Models\Descrizione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class CaricaController extends Controller {
    
    public function carica(){
       return Http::get('https://api.edamam.com/api/recipes/v2?type=public&q=Cioccolato&app_id=d683117b&app_key=2efd83bc8dd404aac01c8a2b391867e5')->json();
    }
    public function home(){
        $api_recipes="https://api.edamam.com/api/recipes/v2/";
        $api_id_recipes="d683117b";
        $api_key="2efd83bc8dd404aac01c8a2b391867e5";
        $array=array();
        $username=session('username');
        $exist = Label::where('username', $username)->pluck('label')->take(3);
        if($exist){
            foreach ($exist as $ind =>$value) {
                $api_recipes_url=$api_recipes.$value.'?'."type=public&app_id=".$api_id_recipes."&app_key=". $api_key;
                $result=Http::get($api_recipes_url)->json();
                $array[$ind]=[$result];
        }
        return $array;
    }
    else
    return json_encode(false);
    }
    public function descrizione(){
        $descrizione = Descrizione::all();
        return $descrizione;
        // return $descrizione;
    }

}
?>