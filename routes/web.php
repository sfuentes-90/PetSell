<?php

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

Route::get('/', 'WelcomeController@index');                         // pagina principal
                        // pagina principal

Route::get('buscar', 'SearchController@buscar2')->name('buscar');   // URL de busqueda
Auth::routes();                                                     // URLs de login
Route::get('home', 'HomeController@index');                        // Panel de control de usuario
Route::resource('avisos', 'AvisosController');

// URLs de Admins
Route::prefix('admin')->group(function(){
  Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::get('avisos', 'SecretariaController@avisos')->name('listar_avisos');
  Route::get('activar_aviso/{id}', 'SecretariaController@activarAviso');
  Route::get('aviso/{id}', 'SecretariaController@show')->name('admin.show_aviso');
  Route::post('aviso/rechazar/', 'SecretariaController@rechazar')->name('admin.rechazar_aviso');
  Route::get('solicitudes_membresia', 'SecretariaController@verMembresias');
  Route::get('activar_membresia/{id}', 'SecretariaController@activarMembresia');
  Route::post('rechazar_membresia', 'SecretariaController@rechazarMembresia');
});



Route::prefix('user')->group(function(){
  Route::get('perfil', 'UserController@index')->name('perfil');
  Route::resource('vender', 'VentasController');                          // URLs del controlador Ventas
  Route::get('/upload', 'AvisosController@uploadForm')->name('upload');   // Subida de imagenes
  Route::post('/upload', 'AvisosController@uploadSubmit')->name('upload');// Subida de imagenes
  Route::resource('avisos', 'AvisosController');                          // URLs del controlador Avisos
  Route::get('/notificaciones', 'UserController@notificaciones');
  Route::get('/comprar_membresia/{id}', 'MembresiasController@show');
  Route::post('/comprar_membresia', 'MembresiasController@store')->name('comprar_membresia');
  Route::get('/valorar_negativa/{id}', 'VentasController@valorar_negativa');
  Route::get('/valorar_positiva/{id}', 'VentasController@valorar_positiva');
  Route::get('/ventas/{id}', 'VentasController@ventas');
  Route::get('planes', function(){ return view('usuario.planes');});
  Route::get('info', 'UserController@info');
  Route::get('editar_usuario', 'UserController@editarUsuario');
  Route::post('actualizar_info', 'UserController@updateInfo');
});
