<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $table = 'clasificacion';
    
    public function getKeyName(){
        return "id_clasificacion";
    }
    use HasFactory;
}
