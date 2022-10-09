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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');

/*

Rutas de Colaboradores

*/
Route::get('/colaboradores/{estado}',array(
    'as'=>'colaboradores',
    'middleware' => 'auth',
    'uses'=>'UserController@colaboradores'
));

Route::post('/agregar-colaborador',array(
    'as'=>'agregar-colaborador',
    'middleware' => 'auth',
    'uses'=>'UserController@agregar'
));

Route::get('/acontisitos',array(
    'as'=>'acontisitos',
    'middleware' => 'auth',
    'uses'=>'UserController@acontisitos'
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

Route::post('agregar-formacion',array(
    'as'=>'agregar-formacion',
    'middleware'=>'auth',
    'uses'=>'FormacionController@agregar'
));

Route::get('eliminar-formacion/{id}',array(
    'as'=>'eliminar-formacion',
    'middleware'=>'auth',
    'uses'=>'FormacionController@eliminar'
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

Route::post('agregar-anexo',array(
    'as'=>'agregar-anexo',
    'middleware'=>'auth',
    'uses'=>'AnexoController@agregar'
));

Route::get('eliminar-anexo/{id}',array(
    'as'=>'eliminar-anexo',
    'middleware'=>'auth',
    'uses'=>'AnexoController@eliminar'
));

Route::get('certificaciones',array(
    'as'=>'certificaciones',
    'middleware'=>'auth',
    'uses'=>'CertificadoLaboralController@certificaciones'
));

Route::get('certificados',array(
    'as'=>'certificados',
    'middleware'=>'auth',
    'uses'=>'CertificadoLaboralController@certificados'
));

Route::get('aprobar-certificado/{id}',array(
    'as'=>'aprobar-certificado',
    'middleware'=>'auth',
    'uses'=>'CertificadoLaboralController@aprobar'
));

Route::get('rechazar-certificado/{id}',array(
    'as'=>'rechazar-certificado',
    'middleware'=>'auth',
    'uses'=>'CertificadoLaboralController@rechazar'
));


Route::get('descargar-certificado/{id}',array(
    'as'=>'descargar-certificado',
    'middleware'=>'auth',
    'uses'=>'CertificadoLaboralController@descargar'
));

Route::post('solicitar-certificado/{id}',array(
    'as'=>'solicitar-certificado',
    'middleware'=>'auth',
    'uses'=>'CertificadoLaboralController@solicitar'
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


Route::post('agregar-hijo/{id}',array(
    'as'=>'agregar-hijo',
    'middleware' => 'auth',
    'uses'=>'HijoColaboradorController@agregar'
));

Route::post('actualizar-hijo/{id}',array(
    'as'=>'actualizar-hijo',
    'middleware' => 'auth',
    'uses'=>'HijoColaboradorController@actualizar'
));

Route::get('eliminar-hijo/{id}',array(
    'as'=>'eliminar-hijo',
    'middleware' => 'auth',
    'uses'=>'HijoColaboradorController@eliminar'
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

Route::post('agregar-empresa',array(
    'as'=>'agregar-empresa',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@agregar'
));

Route::post('actualizar-empresa/{id}',array(
    'as'=>'actualizar-empresa',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@actualizar'
));

Route::post('eliminar-empresa/{id}',array(
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

Route::get('empresa/{id}/estado-cuenta/pdf',"EmpresaController@getEstadoCuentaPdf")
    ->middleware("auth")
    ->name("get.generar.pdf.empresa");

Route::post('empresa/{id}/estado-cuenta/pdf',array(
    'as'=>'generar-pdf-empresa',
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

Route::get('reporte-asistencia/{id}',array(
    'as'=>'reporte-asistencia',
    'middleware' => 'auth',
    'uses'=>'EventoController@reporte'

));

///EMPRESAS CONTADOR

Route::get('/mis-empresas',array(
    'as'=>'mis-empresas',
    'middleware' => 'auth',
    'uses'=>'EmpresaController@misEmpresas'
));

Route::get('perfil-empresa/{id}',array(
    'as'=>'perfil-empresa',
    'middleware' => ['auth'],
    'uses'=>'EmpresaController@perfilEmpresa'
));

Route::get('planeacion/{sede}',array(
    'as'=>'planeacion',
    'middleware'=>'auth',
    'uses'=>'VisitaController@planeacion'
));

Route::get('planeacionasesor',array(
    'as'=>'planeacionasesor',
    'middleware'=>'auth',
    'uses'=>'VisitaController@planeacionasesor'
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

Route::get('referencia-comercial/{id}',array(
    'as'=>'referencia-comercial',
    //'middleware' => 'auth',
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
    'as'=>'agregar-usuarioempresa',
    'middleware'=>'auth',
    'uses'=>'UserController@addusuarioempresa'
));

Route::get('/mostrar-usuarios/{id}',array(
    'as'=>'mostrar-usuarios',
    'middleware'=>'auth',
    'uses'=>'UserController@mostrarUsuarios'
));

Route::post('actualizar-usuarioempresa/{id_usuario}',array(
    'as'=>'actualizar-usuarioempresa',
    'middleware'=>'auth',
    'uses'=>'UserController@updateusuarioempresa'
));

Route::get('eliminar-usuarioempresa/{id_usuario}',array(
    'as'=>'eliminar-usuarioempresa',
    'middleware'=>'auth',
    'uses'=>'UserController@eliminiarusuarioempresa'
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

Route::get('indicadores-visitas',array(
    'as'=>'indicadores-visitas',
    'uses'=>'ReporteController@visitas'
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


Route::post('actualizar-sede/{id}',array(
    'as'=>'actualizar-sede',
    'middleware'=>'auth',
    'uses'=>'SedeController@actualizar'
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

Route::post('actualizar-servicio/{id}',array(
    'as'=>'actualizar-servicio',
    'middleware'=>'auth',
    'uses'=>'ServicioController@actualizar'
));

Route::get('eliminar-servicio/{id}',array(
    'as'=>'eliminar-servicio',
    'middleware'=>'auth',
    'uses'=>'ServicioController@eliminar'
));

Route::post('agregar-tipocliente',array(
    'as'=>'agregar-tipocliente',
    'middleware'=>'auth',
    'uses'=>'TipoClienteController@agregar'
));

Route::post('actualizar-tipocliente/{id}',array(
    'as'=>'actualizar-tipocliente',
    'middleware'=>'auth',
    'uses'=>'TipoClienteController@actualizar'
));

Route::get('eliminar-tipocliente/{id}',array(
    'as'=>'eliminar-tipocliente',
    'middleware'=>'auth',
    'uses'=>'TipoClienteController@eliminar'
));

Route::post('agregar-periodo/{id}',array(
    'as'=>'agregar-periodo',
    'middleware'=>'auth',
    'uses'=>'PeriodoController@agregar'
));

Route::post('editar-periodo/{id}',array(
    'as'=>'editar-periodo',
    'middleware'=>'auth',
    'uses'=>'PeriodoController@editar'
));

Route::get('eliminar-periodo/{id}',array(
    'as'=>'eliminar-periodo',
    'middleware'=>'auth',
    'uses'=>'PeriodoController@eliminar'
));

Route::get('eliminar-anexo/{id}',array(
    'as'=>'eliminar-anexo',
    'middleware'=>'auth',
    'uses'=>'AnexoController@eliminar'
));

Route::get('documentos-periodo/{id}',array(
    'as'=>'documentos-periodo',
    'middleware'=>'auth',
    'uses'=>'PeriodoController@periodo'
));

Route::get('documento-periodo/{id}',array(
    'as'=>'documento-periodo',
    'middleware'=>'auth',
    'uses'=>'PeriodoController@documentos'
));

Route::post('agregar-documentoperiodo/{id}',array(
    'as'=>'agregar-documentoperiodo',
    'middleware'=>'auth',
    'uses'=>'DocumentoPeriodoController@agregar'
));

Route::get('eliminar-documentoperiodo/{id}',array(
    'as'=>'eliminar-documentoperiodo',
    'middleware'=>'auth',
    'uses'=>'DocumentoPeriodoController@eliminar'
));

Route::post('enviar-documentos/{id}',array(
    'as'=>'enviar-documentos',
    'middleware'=>'auth',
    'uses'=>'DocumentoPeriodoController@enviar'
));

Route::get('/documentoperiodo/{filename}',array(
    'as'=>'documentoperiodo',
    'uses'=>'DocumentoPeriodoController@getDocument'
));

Route::get('mi-informacion-contable',array(
    'as'=>'mi-informacion-contable',
    'middleware'=>'auth',
    'uses'=>'PeriodoController@periodos'
));

Route::post('agregar-clasificacion',array(
    'as'=>'agregar-clasificacion',
    'middleware'=>'auth',
    'uses'=>'ClasificacionController@agregar'
));

Route::post('actualizar-clasificacion/{id}',array(
    'as'=>'actualizar-clasificacion',
    'middleware'=>'auth',
    'uses'=>'ClasificacionController@actualizar'
));

Route::get('eliminar-clasificacion/{id}',array(
    'as'=>'eliminar-clasificacion',
    'middleware'=>'auth',
    'uses'=>'ClasificacionController@eliminar'
));

Route::get('hoja-vida/{id}',array(
    'as'=>'hoja-vida',
    //'middleware'=>'auth',
    'uses'=>'UserController@generarhojadevida'
));

Route::post('agregar-cargo',array(
    'as'=>'agregar-cargo',
    'middleware'=>'auth',
    'uses'=>'CargoController@agregar'
));

Route::post('actualizar-cargo/{id}',array(
    'as'=>'actualizar-cargo',
    'middleware'=>'auth',
    'uses'=>'CargoController@actualizar'
));

Route::get('eliminar-cargo/{id}',array(
    'as'=>'eliminar-cargo',
    'middleware'=>'auth',
    'uses'=>'CargoController@eliminar'
));

Route::post('retirar-colaborador/{id}',array(
    'as'=>'retirar-colaborador',
    'middleware'=>'auth',
    'uses'=>'UserController@retirar'
));

Route::get('reingresar-colaborador/{id}',array(
    'as'=>'reingresar-colaborador',
    'middleware'=>'auth',
    'uses'=>'UserController@reingresar'
));

Route::get('proveedores/{estado}',array(
    'as'=>'proveedores',
    'middleware'=>'auth',
    'uses'=>'ProveedorController@index'
));

Route::post('agregar-proveedor',array(
    'as'=>'agregar-proveedor',
    'middleware'=>'auth',
    'uses'=>'ProveedorController@agregar'
));

Route::post('agregar-evaluacion/{id}',array(
    'as'=>'agregar-evaluacion',
    'middleware'=>'auth',
    'uses'=>'EvaluacionProveedorController@agregar'
));

Route::get('/rut/{filename}',array(
    'as'=>'documentoRut',
    'uses'=>'ProveedorController@getRut'
));

Route::get('/comercio/{filename}',array(
    'as'=>'documentoComercio',
    'uses'=>'ProveedorController@getComercio'
));

Route::get('/cedula/{filename}',array(
    'as'=>'documentoCedula',
    'uses'=>'ProveedorController@getCedula'
));

Route::get('/referencia/{filename}',array(
    'as'=>'documentoReferencia',
    'uses'=>'ProveedorController@getReferencia'
));

Route::get('/seguridad/{filename}',array(
    'as'=>'documentoSeguridad',
    'uses'=>'ProveedorController@getSeguridad'
));

Route::get('/sig/{filename}',array(
    'as'=>'documentoSig',
    'uses'=>'ProveedorController@getSig'
));


Route::post('/eliminar-proveedor/{id}',array(
    'as'=>'eliminar-proveedor',
    'middleware'=>'auth',
    'uses'=>'ProveedorController@eliminar'
));

Route::post('/actualizar-proveedor/{id}',array(
    'as'=>'actualizar-proveedor',
    'middleware'=>'auth',
    'uses'=>'ProveedorController@actualizar'
));

Route::get('reporte-colaboradores/{estado}',array(
    'as'=>'reporte-colaboradores',
    'uses'=>'UserController@reporte'
));


Route::get('/registrar-usuariocompanies',array(
    'as'=>'registrar-usuariocompanies',
    'middleware'=>'auth',
    'uses'=>'UserController@usercompanies'
));