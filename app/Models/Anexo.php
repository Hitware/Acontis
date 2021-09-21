<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    use HasFactory;
    protected $table = 'anexos';

    public function getKeyName(){
        return "id_anexo";
    }
}
