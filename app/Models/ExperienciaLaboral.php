<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboral extends Model
{
    use HasFactory;
    protected $table = 'experiencia_laboral';

    public function getKeyName(){
        return "id_experiencia";
    }
}
