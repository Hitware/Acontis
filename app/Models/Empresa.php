<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    
    protected $table = 'companies';

    public function getKeyName() 
    {
        return "id_company";
    }

    public function changeConnection() 
    {
        if($this->name_bd_adm == null) return;

        $connection = "CLIENT_{$this->tipo_cliente}";

        config([
            'database.default' => $connection,
            "database.connections.{$connection}.database" => $this->name_bd_adm
        ]);
    }
}
