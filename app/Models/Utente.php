<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
class Utente extends Model 
{
    protected $connection = "mysql" ;

    use HybridRelations ;
    protected $table="utente";
    public $timestamps = false;
    protected $fillable = ['username','cellulare','email','password'];
    public function label(){
        return $this->belongsToMany("Label","user_id");
    }
    public function creation(){
        return $this->hasMany("Creation","user_id","creation_id");
    }
    public function descrizione(){
        return $this->hasOne("Descrizione");
    }
}


?>