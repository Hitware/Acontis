<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
        protected $table = 'companies';

        public function getKeyName(){
            return "id_company";
        }
        
        use HasFactory;
}
