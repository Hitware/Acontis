<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'actividades';

    public function getKeyName(){
        return "id_actividad";
    }

    use HasFactory;
}
