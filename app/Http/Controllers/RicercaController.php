<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Label;
use App\Models\Utente;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class RicercaController extends Controller {
    public function ricetta($value){
        $api_recipes="https://api.edamam.com/api/recipes/v2?type=public&";
        $api_id_recipes="d683117b";
        $api_key="2efd83bc8dd404aac01c8a2b391867e5";
        return Http::get($api_recipes.'&q='.$value.'&app_id='.$api_id_recipes.'&app_key='.$api_key)->json();
    }
    public function spotify(){
        $spotify_url="https://api.spotify.com/v1/browse/new-releases";
        $spotify_token='https://accounts.spotify.com/api/token';
        $client_id="dd29f8370e0d463c9b9f85f2753fc3a8";
        $client_secret="d697efff6c854e128b796cf46962505c";

        $token = Http::asForm()->withHeaders([
            'Authorization' => 'Basic '.base64_encode($client_id.':'.$client_secret),
        ])->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
        ]);
        if ($token->failed()) abort(500);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token['access_token']
        ])->get($spotify_url);
        if($response->failed()) abort(500);

        return $response->body();
    }
    public function utente($utente){
        $api_recipes="https://api.edamam.com/api/recipes/v2/";
        $api_id_recipes="d683117b";
        $api_key="2efd83bc8dd404aac01c8a2b391867e5";
        $username=session('username');
        $user=session('user_id');
        $exist = Utente::where('username', $utente)->where('username','<>',$username)->exists();
        if($exist){
            $salvati=Label::where('username',$utente)->exists();
        if($salvati){
            $get=Label::where('username',$utente)->take(3)->pluck('label');
        foreach ($get as $ind => $value) {
            $api_recipes_url=$api_recipes.$value.'?'."type=public&app_id=".$api_id_recipes."&app_key=". $api_key;
            $result=Http::get($api_recipes_url)->json();
            $array[$ind]=[$result];
        }
        return json_encode($return=['0'=>$array,'1'=>true]);
    }else
    return json_encode($error=['0'=>false,'1'=>true]);
        
    }else
    return json_encode($error=['0'=>true,'1'=>false]);
}
}
?>