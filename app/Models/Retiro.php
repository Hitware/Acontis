<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retiro extends Model
{
    use HasFactory;
    protected $table = 'colaborador_retiro';

    public function getKeyName(){
        return "id_retiro";
    }
}
