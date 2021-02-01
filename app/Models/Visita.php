<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'evento';
    
    public function getKeyName(){
        return "id_evento";
    }
    use HasFactory;

}
