<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';
    
    public function getKeyName(){
        return "id_alerta";
    }
    use HasFactory;
}
