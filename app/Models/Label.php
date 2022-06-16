<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Label extends Model 
{
    protected $connection = "mysql" ;
    public $timestamps = false;
    protected $fillable = ['label','username','user_id'];
    public function utente(){
        return $this->belongsToMany("Utente");
    }
    public function creation(){
        return $this->hasMany("Creation","label");
    }
}


?>