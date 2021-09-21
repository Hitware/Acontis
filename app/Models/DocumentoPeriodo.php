<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoPeriodo extends Model
{
    use HasFactory;
    protected $table = 'documento_periodo';

    public function getKeyName(){
        return "id_documento_periodo";
    }
}
