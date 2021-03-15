<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    use HasFactory;
    protected $table = 'educacion';

    public function getKeyName(){
        return "id_educacion";
    }
}
