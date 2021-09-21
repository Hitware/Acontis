<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HijoColaborador extends Model
{
    use HasFactory;
    protected $table = 'hijos_colaboradores';

    public function getKeyName(){
        return "id_hijoscolaboradores";
    }
}
