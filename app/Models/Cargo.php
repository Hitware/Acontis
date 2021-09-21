<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';

    public function getKeyName(){
        return "id_cargo";
    }

    use HasFactory;
}
