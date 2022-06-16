<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Creation extends Model 
{
    protected $connection = "mysql" ;
    protected $primaryKey="creation_id";
    protected $fillable = ['user_id','username','label','preparazione','img'];

    public $timestamps = false;
    public function utente(){
        return $this->belongsTo("Utente",'user_id','id');
    }
    public function label(){
        return $this->belongsTo("Label",'label');
    }
}


?>