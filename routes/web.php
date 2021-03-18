<?php

use Illuminate\Support\Facades\Route;
use App\Mail\RegistroMailable;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*

Rutas de Colaboradores

*/
Route::get('/colaboradores',array(
    'as'=>'colaboradores',
    'middleware' => 'auth',
    'uses'=>'UserController@colaboradores'
));

Route::post('/agregar-colaborador',array(
    'as'=>'agregar-colaborador',
    'middleware' => 'auth',
    'uses'=>'UserController@agregar'
));

Route::get('/perfil-colaborador/{id}',array(
    'as'=>'perfil-colaborador',
    'middleware' => 'auth',
    'uses'=>'UserController@perfil'
));

Route::post('actualizar-colaborador/{id}',array(
    'as'=>'actualizar-colaborador',
    'middleware' => 'auth',
    'uses'=>'UserController@actualizar'
));

Route::get('eliminar-colaborador/{id}',array(
    'as'=>'eliminar-colaborador',
    'middleware' => 'auth',
    'uses'=>'UserController@eliminar'
));

Route::get('asignaciones',array(
    'as'=>'asignaciones',
    'middleware'=>'auth',
    'uses'=>'UserController@asignaciones'
));

Route::get('hoja-de-vida',array(
    'as'=>'hoja-de-vida',
    'middleware'=>'auth',
    'uses'=>'UserController@hojadevida'
));

Route::post('agregar-educacion',array(
    'as'=>'agregar-educacion',
    'middleware'=>'auth',
    'uses'=>'EducacionController@agregar'
));

Route::get('eliminar-educacion/{id}',array(
    'as'=>'eliminar-educacion',
    'middleware'=>'auth',
    'uses'=>'EducacionController@eliminar'
));


Route::post('agregar-experiencia',array(
    'as'=>'agregar-experiencia',
    'middleware'=>'auth',
    'uses'=>'ExperienciaLaboralController@agregar'
));

Route::get('eliminar-experiencia/{id}',array(
    'as'=>'eliminar-experiencia',
    'middleware'=>'auth',
    'uses'=>'ExperienciaLaboralController@eliminar'
));

Route::get('reportes-colaborador',array(
    'as'=>'reportes-colaborador',
    'middleware' => 'auth',
    'uses'=>'UserController@reportes'
));

Route::post('reportes-colaborador',array(
    'as'=>'reportes-colaborador',
    'middleware' => 'auth',
    'uses'=>'UserController@reportespdf'
));

Route::post('agregar-titulo/{id}',array(
    'as'=>'agregar-titulo',
    'middleware' => 'auth',
    'uses'=>'TituloController@agregar'
));

Route::get('/titulo/{filename}',array(
    'as'=>'tituloColaborador',
    'uses'=>'TituloController@getTitulo'
));

Route::get('perfil-usuario',array(
    'as'=>'perfil-usuario',
    'middleware' => 'auth',
    'uses'=>'UserController@perfilUsuario'
));

Route::post('actualizar-perfil/{id}',array(
    'as'=>'actualizar-perfil',
    'middleware' => 'auth',
    'uses'=>'UserController@actualizarPerfil'
));

Route::get('/fotoperfil/{filename}',array(
    'as'=>'fotoperfil',
    'uses'=>'UserController@getImagen'
));

Route::post('api/login','UserController@login');
/*
planeacion
Rutas de Empresas

*/
Route::get('/empresas/{nombre}',array(
    'as'=>'empresas',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@empresas'
));

Route::post('/agregar-empresa',array(
    'as'=>'agregar-empresa',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@agregar'
));

Route::post('actualizar-empresa/{id}',array(
    'as'=>'actualizar-empresa',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@actualizar'
));

Route::get('eliminar-empresa/{id}',array(
    'as'=>'eliminar-empresa',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@eliminar'
));

Route::get('enviar-qr/{id}',array(
    'as'=>'enviar-qr',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@enviarCorreo'
));

Route::post('empresas-total',array(
    'as'=>'empresas-total',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@empresasTotal'
));

Route::post('empresas-asignadas',array(
    'as'=>'empresas-asignadas',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@empresasAsignadas'
));

Route::post('asignar-empresa',array(
    'as'=>'asignar-empresa',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@asignarEmpresa'
));

Route::post('asignar-empresa-uno',array(
    'as'=>'asignar-empresa-uno',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@asignarEmpresaP'
));

Route::post('asignar-empresa-dos',array(
    'as'=>'asignar-empresa-dos',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@asignarEmpresaS'
));

Route::post('desasignar',array(
    'as'=>'desasignar',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@desasignar'
));

Route::get('excel-empresas',array(
    'as'=>'excel-empresas',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@excel'
));

Route::get('reportes-empresa',array(
    'as'=>'reportes-empresa',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@reportes'
));

Route::post('mostrar-reportes',array(
    'as'=>'mostrar-reportes',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@reportespdf'
));

Route::get('generar-pdf/{id_reporte}',array(
    'as'=>'generar-pdf',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@generarpdf'
));


Route::get('empresa/{id}/estado-cuenta/pdf',array(
    'as'=>'generar-pdf',
    'middleware' => ["auth"],
    'uses'=>'EmpresaController@generarEstadoCuentaPdf'
));

//RUTAS DE EVENTOS

Route::get('eventos',array(
    'as'=>'eventos',
    'middelware'=>'auth',
    'uses'=>'EventoController@eventos'
));

Route::post('/agregar-evento',array(
    'as'=>'agregar-evento',
    'middelware'=>'auth',
    'uses'=>'EventoController@agregar'
));

Route::get('eliminar-evento/{id}',array(
    'as'=>'eliminar-evento',
    'middleware' => 'auth',
    'uses'=>'EventoController@eliminar'
));

Route::post('/actualizar-evento/{id}',array(
    'as'=>'actualizar-evento',
    'middleware' => 'auth',
    'uses'=>'EventoController@actualizar'
));

///EMPRESAS CONTADOR

Route::get('/mis-empresas',array(
    'as'=>'mis-empresas',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@misEmpresas'
));

Route::get('perfil-empresa/{idempresa}',array(
    'as'=>'perfil-empresa',
    'middleware' => ['auth'],
    'uses'=>'EmpresaController@perfilEmpresa'
));

Route::get('planeacion/{sede}',array(
    'as'=>'planeacion',
    'middleware'=>'auth',
    'uses'=>'VisitaController@planeacion'
));

Route::post('actualizar-planificacion',array(
    'as'=>'actualizar-planificacion',
    'middleware'=>'auth',
    'uses'=>'VisitaController@update'
));

Route::post('borrar-planificacion',array(
    'as'=>'borrar-planificacion',
    'middleware'=>'auth',
    'uses'=>'VisitaController@borrar'
));

//DOCUMENTOS

Route::post('agregar-documento/{id_empresa}',array(
    'as'=>'agregar-documento',
    'middleware'=>'auth',
    'uses'=>'DocumentoController@agregar'
));

Route::post('agregar-doc',array(
    'as'=>'agregar-doc',
    'middleware'=>'auth',
    'uses'=>'DocumentoController@add'
));

Route::post('modificar-documento/{id_documento}',array(
    'as'=>'modificar-documento',
    'middleware'=>'auth',
    'uses'=>'DocumentoController@modificar'
));

Route::get('/documento/{filename}',array(
    'as'=>'documentoEmpresa',
    'uses'=>'DocumentoController@getDocument'
));

Route::get('/documentoacontis/{filename}',array(
    'as'=>'documentoacontis',
    'uses'=>'DocumentoController@getDocEmpresa'
));

Route::get('solicitudes',array(
    'as'=>'solicitudes',
    'middleware'=>'auth',
    'uses'=>'DocumentoController@solicitud'
));

Route::get('referencia-comercial',array(
    'as'=>'referencia-comercial',
    'middleware' => 'auth',
    'uses'=>'DocumentoController@generarpdf'
));
//PLANEACION

Route::post('agregar-planeacion',array(
    'as'=>'agregar-planeacion',
    'middleware'=>'auth',
    'uses'=>'VisitaController@agregar'
));

//ALERTAS

Route::post('agregar-alerta/{id_empresa}',array(
    'as'=>'agregar-alerta',
    'middleware'=>'auth',
    'uses'=>'AlertaController@agregar'
));

//Agregar Usuario Empresa

Route::post('agregar-usuarioempresa/{id_empresa}',array(
    'as'=>'agregar-usuario-empresa',
    'middleware'=>'auth',
    'uses'=>'UserController@addusuarioempresa'
));

Route::get('configuracion',array(
    'as'=>'configuracion',
    'middleware'=>'auth',
    'uses'=>'ConfiguracionController@index'
));

Route::post('agregar-tipodocumento',array(
    'as'=>'agregar-tipodocumento',
    'middleware'=>'auth',
    'uses'=>'ConfiguracionController@agregar'
));

Route::get('eliminar-tipodocumento/{id}',array(
    'as'=>'eliminar-tipodocumento',
    'middleware'=>'auth',
    'uses'=>'ConfiguracionController@eliminar'
));

Route::get('reportes',array(
    'as'=>'reportes',
    'middleware'=>'auth',
    'uses'=>'ReporteController@reportes'
));

Route::get('reporte-cliente/{id}',array(
    'as'=>'reporte-cliente',
    'uses'=>'ReporteController@cliente'
));

Route::get('indicadores',array(
    'as'=>'indicadores',
    'uses'=>'ReporteController@indicadores'
));

Route::post('actualizar-reporte/{id}',array(
    'as'=>'actualizar-reporte',
    'uses'=>'ReporteController@actualizar'
));

Route::get('recorrer-eventos',array(
    'as'=>'recorrer-eventos',
    'uses'=>'UserController@recorrer'
));

//ALERTAS

Route::get('alertas',array(
    'as'=>'alertas',
    'middleware'=>'auth',
    'uses'=>'NotificacionesController@index'
));

Route::post('agregar-notificacion',array(
    'as'=>'agregar-notificacion',
    'middleware'=>'auth',
    'uses'=>'NotificacionesController@agregar'
));

//SEDES

Route::post('agregar-sede',array(
    'as'=>'agregar-sede',
    'middleware'=>'auth',
    'uses'=>'SedeController@agregar'
));

Route::get('eliminar-sede/{id}',array(
    'as'=>'eliminar-sede',
    'middleware'=>'auth',
    'uses'=>'SedeController@eliminar'
));

//
Route::post('agregar-servicio',array(
    'as'=>'agregar-servicio',
    'middleware'=>'auth',
    'uses'=>'ServicioController@agregar'
));

Route::get('eliminar-servicio/{id}',array(
    'as'=>'eliminar-servicio',
    'middleware'=>'auth',
    'uses'=>'ServicioController@eliminar'
));

Route::post('agregar-tipocliente',array(
    'as'=>'eliminar-tipocliente',
    'middleware'=>'auth',
    'uses'=>'TipoClienteController@agregar'
));

Route::get('eliminar-tipocliente/{id}',array(
    'as'=>'eliminar-tipocliente',
    'middleware'=>'auth',
    'uses'=>'TipoClienteController@eliminar'
));
