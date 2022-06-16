<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Creation;
use App\Models\Utente;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class CreazioneController extends Controller {
    public function carica($bool){
    // $array=array();
     if($bool)
     $username=session('username');
     else
     $username=$bool;
     $exist = Creation::where('username', $username)->exists();
     if($exist){
        $creation=Creation::where('username', $username)->take(3)->get();
         foreach ($creation as $ind =>$value){
          
             $array[$ind]=['label'=>$value['label'],'box'=>$value['preparazione'],'img'=>$value['img']];
         }
         return json_encode($array);
     }else{
         return json_encode(false);
     }
    }
   public function cancella($id){
    $username=session('username');
    $user=session('user_id');

    $exist = Creation::where('username', $username)->where('label',$id)->exists();
    if($exist){
        Creation::where('label',$id)->delete();
    }

   }
   public function invia(){
    $username=session('username');
    $user=session('user_id');
    $request=request()->all();
    //conta pure token ed submit
    if (count($request)==5) {
        $size = request('img')->getSize();
     $type = request('img')->Extension();
     $allowedExt = array('png'=>IMAGETYPE_PNG , 'jpg'=>IMAGETYPE_JPEG );
        if ($allowedExt[$type]) {
        if ($size < 7000000){
         $fileNameNew=uniqid('', true).".".$type;
         $destinationPath = 'images/';
        $fileName=request('img')->getClientOriginalName();
         request('img')->move($destinationPath,$fileNameNew);
         $query = Utente::where('username', $username)->get();
         if($query)
         { 
            $newUser =  Creation::create([
                'user_id' => $user,
                'username'=> $username,
                'label' => $request['titolo'],
                'preparazione' => $request['preparazione'],
                'img' => $destinationPath.$fileNameNew,
                ]);
                
         }
     }}
    }
     
   }
}
?>