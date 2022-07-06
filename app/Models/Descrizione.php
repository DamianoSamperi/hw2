<?php
namespace App\Models;
//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Descrizione extends Model
{
	protected $connection = 'mongodb';
    use HybridRelations ;
	protected $collection = 'Descrizione';



    protected $fillable = [
        'testo'
    ];

    public function utente(){
        return $this->hasOne("Utente","username","username");
    }
}