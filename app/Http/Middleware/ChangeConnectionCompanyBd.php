<?php

namespace App\Http\Middleware;

use App\Models\Empresa;
use Closure;
use Illuminate\Http\Request;

class ChangeConnectionCompanyBd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route("id");
        $company = Empresa::findOrFail($id);
        $connection = "CLIENT_{$company->tipo_cliente}";
        
        config([
            'database.default' => $connection,
            "database.connections.{$connection}.database" => $company->name_bd_adm
        ]);

        return $next($request);
    }
}
