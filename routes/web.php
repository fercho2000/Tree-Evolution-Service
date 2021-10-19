<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;


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

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::get('/', function () {
    return view('page/index');
});

Auth::routes();

Route::get('/clientes/reporteexcel', 'ClienteController@ReporteExcecl');

//Routes
Route::middleware(['preventbackbutton', 'auth'])->group(function () {
    Route::get('/index2', 'HomeController@index')->name('index2');
    Route::get('/user_profile', 'HomeController@perfil')->name('user_profile.perfil');

    //Configuracion del perfil de usuario
    Route::get('/config', 'ConfigController@index')->name('config.index');
    Route::put('/config/{user}/user', 'ConfigController@userupdate')->name('config.userupdate');
    Route::put('/config/{user}/contra', 'ConfigController@contrasenaupdate')->name('config.contrasenaupdate');
    Route::post('/config/{id}/empleado', 'ConfigController@empupdate')->name('config.empupdate');
    Route::post('/config/{id}/foto', 'ConfigController@fotoupdate');

    // Utilizo controlador ordenservicio para redireccionar  login
    // Route::get('/index2', 'OrdenServicioController@index2');
    // Rutas para  Orden De  servicio
    Route::get('/ordenservicio', 'OrdenServicioController@index');
    Route::get('/ordenservicio/{orden}/editar', 'OrdenServicioController@editar');
    Route::get('/ordenservicio/{orden}/show', 'OrdenServicioController@show');
    Route::get('/ordenservicio/crear', 'OrdenServicioController@crear');
    Route::post('/ordenservicio/update', 'OrdenServicioController@update');
    Route::post('/ordenservicio/guardar', 'OrdenServicioController@guardar');
    Route::post('/ordenservicio/RemoverServicio', 'OrdenServicioController@remover');
    // Estas dos rutas de abonos las creo para registrar y pintar los
    //  valores del abono apenas cargue la pagina
    Route::post('/ordenservicio/Abono', 'OrdenServicioController@Abono');
    Route::post('/ordenservicio/AbonoConsulta', 'OrdenServicioController@AbonoConsulta');
    Route::post('/ordenservicio/UpdateAbonoConsulta', 'OrdenServicioController@UpdateAbonoConsulta');

    // Ruta de consulta ajax que trae los servicios que tienen el id del tipo de servicios que llega en el request
    Route::get('/ordenservicio/consultaservicios', 'OrdenServicioController@Ajaxconsultaservicios');
    Route::GET('/Consulta/Ordenes/{id}', ['as' => 'QueryOrdenServicio', 'uses' => 'OrdenServicioController@Generar_PDF']);
    //Rutas para la programacion
    Route::GET('/programacion', 'ProgramacionController@index')->name('programacionIndex');
    Route::GET('/Programacion/create/{id}', ['as' => 'ProgramacionCreate', 'uses' => 'ProgramacionController@create']);
    Route::GET('/Programacion/verOrden', 'ProgramacionController@VerOrdenes');
    Route::GET('/Programacion/VerDiasBitacora', 'ProgramacionController@VerDiasBitacora');
    Route::GET('/Programacion/verEmpleado', 'ProgramacionController@verEmpleado');
    Route::GET('/Programacion/verKit', 'ProgramacionController@verKit');
    Route::GET('/Programacion/KitsEmpleados', 'ProgramacionController@verEmpleadoKits');
    Route::GET('/Programacion/ImplesKit', 'ProgramacionController@Nuevosimplementosalkit');
    Route::GET('/Programacion/verOrden', 'ProgramacionController@VerOrdenes');
    Route::POST('/Programacion/create', 'ProgramacionController@store');
    Route::POST('/Programacion/update/kit', 'ProgramacionController@ActualizarKit');
    Route::GET('/Programacion/Show/Empleado', 'ProgramacionController@VerEmpleadosBitacora');
    Route::GET('/Programacion/Show/Kits', 'ProgramacionController@VerKitsBitacora');
    Route::GET('/Programacion/Show', 'ProgramacionController@show');
    Route::GET('/Programacion/Show/{id}', 'ProgramacionController@showBitacora')->name('verBitacora');
    Route::GET('/Programacion/Edit', 'ProgramacionController@Edit');
    Route::POST('/Programacion/delete/empleado ', 'ProgramacionController@destroyEmpleadosBitacora');
    Route::POST('/Programacion/delete/kit', 'ProgramacionController@destroyKitsBitacora');
    Route::POST('/Programacion/Update', 'ProgramacionController@update');
    Route::POST('/Programacion/Destroy', 'ProgramacionController@destroy');
    Route::POST('/Programacion/CambiarEstadoOrden', 'ProgramacionController@destroyOrdenServicio');
    Route::GET('/Programacion/Agendar', 'ProgramacionController@Bitacora');
    Route::POST('/Programacion/RegistrarNovedad', 'ProgramacionController@RegistrarNovedad');

    //Rutas para las novedades de las ordenes
    Route::GET('/Novedadorden', 'NovedadOrdenController@index')->name('NovedadOrdenIndex');
    Route::GET('/NovedadOrden/Show', 'NovedadOrdenController@show');
    Route::GET('/NovedadOrden/Edit', 'NovedadOrdenController@edit');

    // Rutas para Tipo de servicio
    Route::get('/tiposervicio', 'TipoServicioController@index');
    Route::get('/tiposervicio/editar', 'TipoServicioController@editar');
    Route::post('/tiposervicio/update', 'TipoServicioController@update');
    Route::post('/tiposervicio/guardar', 'TipoServicioController@guardar');
    Route::post('/tiposervicio/estado', 'TipoServicioController@CambioEstado');
    Route::post('/tiposervicio/validarigual', 'TipoServicioController@Cambiovalidarigual');
    // Rutas para  servicios
    Route::get('/servicio', 'ServicioController@index');
    Route::get('/servicio/editar', 'ServicioController@editar');
    Route::post('/servicio/update', 'ServicioController@update');
    Route::post('/servicio/guardar', 'ServicioController@guardar');
    Route::post('/servicio/delete', 'ServicioController@delete');
    Route::post('/servicio/estado', 'ServicioController@CambioEstado');

    // Rutas para  Estado Ordenes,servicio,programaciòn
    Route::get('/estados', 'EstadosController@index');
    Route::get('/estados/editar', 'EstadosController@editar');
    Route::post('/estados/update', 'EstadosController@update');
    Route::post('/estados/guardar', 'EstadosController@guardar');
    Route::post('/estados/delete', 'EstadosController@delete');

    // Rutas para  Crud de clientes
    Route::get('/clientes', 'ClienteController@index');
    Route::get('/clientes/editar', 'ClienteController@editar');
    Route::post('/clientes/update', 'ClienteController@update');
    Route::post('/clientes/guardar', 'ClienteController@guardar');
    Route::post('/clientes/delete', 'ClienteController@delete');
    Route::get('/clientes/{id}/pdf', 'ClienteController@Clientepdf');

    // Rutas para  Llenar la tabla detalle,,  agregar servicios a orden de servicio
    Route::get('/DetalleOrdenServicio', 'ControllerOrdenservicioDetalleServicios@index');
    Route::get('/DetalleOrdenServicio/editar', 'ControllerOrdenservicioDetalleServicios@editar');
    Route::post('/DetalleOrdenServicio/update', 'ControllerOrdenservicioDetalleServicios@update');
    Route::post('/DetalleOrdenServicio/guardar', 'ControllerOrdenservicioDetalleServicios@guardar');
    Route::post('/DetalleOrdenServicio/delete', 'ControllerOrdenservicioDetalleServicios@delete');

    //Rutas para agenda
    Route::GET('/Agenda', 'AgendaController@Agendaindex');
    Route::GET('/Agenda/calendar', 'AgendaController@Agendafullcalendar');
    Route::POST('/Agenda/guardar', 'AgendaController@Agendaguardar');
    Route::GET('/Agenda/editar', 'AgendaController@AgendaEditar');
    Route::POST('/Agenda/update', 'AgendaController@AgendaUpdate');
    Route::POST('/Agenda/eliminar', 'AgendaController@AgendaEliminar');
    // ----------------------------
    // IMPLEMENTOS DE TRABAJO
    // ----------------------------
    // CATEGORIAS
    Route::GET('categoria', ['as' => 'categoria', 'uses' => 'CategoriaController@index']);
    Route::POST('/Categoria/create', 'CategoriaController@store');
    Route::GET('/Categoria/edit', 'CategoriaController@edit');
    Route::POST('/Categoria/update', 'CategoriaController@update');
    Route::GET('/Categoria/show', 'CategoriaController@show');
    Route::POST('deleteCategoria', 'CategoriaController@destroy');

    // IMPLEMENTOS
    Route::GET('implemento', ['as' => 'implemento', 'uses' => 'ImplementoController@index']);
    Route::POST('/Implemento/create', 'ImplementoController@store');
    Route::GET('/Implemento/edit', 'ImplementoController@edit');
    Route::POST('/Implemento/update', 'ImplementoController@update');
    Route::GET('/Implemento/show', 'ImplementoController@show');
    Route::POST('/Implemento/destroy', 'ImplementoController@destroy');
    Route::GET('Consulta/Implementos', ['as' => 'QueryImplemento', 'uses' => 'ImplementoController@Generar_PDF']);

    //NOVEDADES
    Route::GET('novedadimplemento', ['as' => 'novedadimplemento', 'uses' => 'NovedadImplementoController@index']);
    Route::POST('/Novedad/create', 'NovedadImplementoController@store');
    Route::GET('/Novedad/edit', 'NovedadImplementoController@edit');
    Route::POST('/Novedad/update', 'NovedadImplementoController@update');
    Route::GET('showNovedad/{id}', ['as' => 'show', 'uses' => 'NovedadImplementoController@show']);
    Route::POST('/Novedad/destroy', 'NovedadImplementoController@destroy');
    //nueva route
    Route::GET('Novedad/Implementos', ['as' => 'QueryNovedad', 'uses' => 'NovedadImplementoController@Generar_PDF']);


    //KITS
    Route::GET('kit', ['as' => 'kit', 'uses' => 'KitController@index']);
    Route::GET('create', ['as' => 'create', 'uses' => 'KitController@create']);
    Route::GET('show/kit/{id}', ['as' => 'showKit', 'uses' => 'KitController@show']);
    Route::GET('edit/kit/{id}', ['as' => 'showEdit', 'uses' => 'KitController@edit']);
    Route::POST('/Kit/create', 'KitController@store');
    Route::GET('/Kit/edit', 'KitController@edit');
    Route::GET('/Kit/MostrarImplemento', 'KitController@MostrarImplemento');
    Route::GET('/Kit/Implementos_Kit', 'KitController@TraerImplementos');
    Route::POST('/Kit/update', 'KitController@update');
    Route::POST('/Kit/update/implementos', 'KitController@updateImplementos');
    Route::POST('/Kit/destroy', 'KitController@destroy');
    Route::GET('/Kit/show', 'KitController@show');
    Route::POST('/edit/update', 'KitController@update');
    Route::GET('Consulta/kits/{id}', ['as' => 'QueryKit', 'uses' => 'KitController@Generar_PDF']);
    //nueva route
    Route::GET('Consulta/kits', ['as' => 'QueryKitGeneral', 'uses' => 'KitController@Generar_PDF_General']);

    //KIT_HAS_IMPLEMENTO
    Route::POST('/Kit/Implementos_has_Kit', 'Kit_Has_Implemento@store');
    Route::GET('/Kit/showImplementos', 'Kit_Has_Implemento@show');
    Route::POST('/edit/delete', 'Kit_Has_Implemento@destroy');

    //VISITAS
    Route::GET('visita', ['as' => 'visita', 'uses' => 'VisitaController@index']);
    Route::POST('/Visita/create', 'VisitaController@store');
    Route::GET('/Visita/edit', 'VisitaController@edit');
    Route::POST('/Visita/update', 'VisitaController@update');
    Route::GET('/Visita/show', 'VisitaController@show');
    Route::POST('/Visita/destroy', 'VisitaController@destroy');
    Route::GET('/Visita/consultacalendar', 'VisitaController@consultafullcalendar');
    //nueva route
    Route::GET('Consulta/Visita', ['as' => 'QueryVisit', 'uses' => 'VisitaController@Generar_PDF']);


    //Roles
    Route::post('/roles/store', 'RoleController@store')->name('roles.store');

    Route::get('/roles', 'RoleController@index')->name('roles.index');

    Route::get('/roles/create', 'RoleController@create')->name('roles.create');

    Route::put('/roles/{role}', 'RoleController@update')->name('roles.update');

    Route::get('roles/{role}', 'RoleController@show')->name('roles.show');

    Route::delete('/roles/{role}', 'RoleController@destroy')->name('roles.destroy');

    Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');

    //Users
    Route::post('/users/store', 'UserController@store')->name('users.store');

    Route::get('/users', 'UserController@index')->name('users.index');

    Route::get('/users/create', 'UserController@create')->name('users.create');

    Route::put('/users/{user}', 'UserController@update')->name('users.update');

    Route::get('/users/{user}', 'UserController@show')->name('users.show');

    Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');

    Route::post('/userestado', 'UserController@destroy2')->name('users.estado');



    //Rutas empleado
    Route::get('/empleado', 'empleadoController@index')->name('empleado.index');

    Route::get('/empleado/crear', 'empleadoController@create')->name('empleado.create');

    Route::post('/empleado/guardar', 'empleadoController@store')->name('empleado.store');

    Route::get('/empleado/{id}/mostrar', 'empleadoController@show')->name('empleado.show');

    Route::get('/empleado/{id}/modificar', 'empleadoController@edit')->name('empleado.edit');

    Route::get('/empleado/{id}/pdf', 'empleadoController@pdf')->name('empleado.pdf');

    Route::post('/empleado/{id}/actualizar', 'empleadoController@update')->name('empleado.update');

    Route::post('/empleadoestado', 'empleadoController@destroy')->name('empleado.estado');

    Route::post('/empleado/{id}/eliminar', 'empleadoController@destroy')->name('empleado.destroy');

    Route::get('/empleado/{id}/CrearUser', 'empleadoController@CrearUser')->name('empleado.CrearUser');

    Route::post('/empleado/guardarUser', 'empleadoController@CrearUserr')->name('empleado.CrearUserr');

    //Rutas cargos
    Route::get('/cargo', 'cargoController@index')->name('cargo.index');

    Route::get('/cargo/crear', 'cargoController@create')->name('cargo.create');

    Route::post('/cargo/guardar', 'cargoController@store')->name('cargo.store');

    Route::get('/cargo/modificar', 'cargoController@edit')->name('cargo.edit');

    Route::post('/cargo/actualizar', 'cargoController@update')->name('cargo.update');



    Route::get('/ciudad', 'CiudadController@index')->name('ciudad.index');

    Route::post('/ciudad/guardar', 'CiudadController@store')->name('ciudad.store');

    Route::get('/ciudad/mostrar', 'CiudadController@show')->name('ciudad.show');

    Route::post('/ciudad/modificar', 'CiudadController@update')->name('ciudad.update');

    Route::get('/ciudad/ver', 'CiudadController@editar')->name('ciudad.edit');
});
