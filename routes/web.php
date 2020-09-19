<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@index');
Route::get('/buscar/{b?}', 'PageController@buscar');
Route::get('/productos/{id}', 'PageController@producto');
Route::get('/anexo/{nombre}', 'PageController@anexo');

Auth::routes();
Route::middleware('auth')->get('/generacion_api','ApiTokenController@update');

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->post('/pedido/{id}','PedidoController@store');

Route::middleware(['auth','superusuario'])->get('/parametros-globales','GlobalesController@index');
Route::middleware(['auth','superusuario'])->post('/parametros-globales','GlobalesController@store');
Route::middleware(['auth','superusuario'])->post('/parametros-globales/{id}','GlobalesController@update');
Route::middleware(['auth','superusuario'])->get('/parametros-globales/{id}','GlobalesController@delete');


Route::middleware(['auth','superusuario'])->post('/banner','GlobalesController@storeban');
Route::middleware(['auth','superusuario'])->get('/banner/{id}','GlobalesController@deleteban');


Route::middleware(['auth','superusuario'])->get('/categorias-subcategorias','CategoriaController@index');
Route::middleware(['auth','superusuario'])->post('/categorias','CategoriaController@store');
Route::middleware(['auth','superusuario'])->get('/categorias/{id}','CategoriaController@delete');
Route::middleware(['auth','superusuario'])->post('/subcategorias','SubcategoriaController@store');
Route::middleware(['auth','superusuario'])->get('/subcategorias/{id}','SubcategoriaController@delete');



Route::middleware(['auth','superusuario'])->get('/producto','ProductoController@index');
Route::middleware(['auth','superusuario'])->post('/producto','ProductoController@store');
Route::middleware(['auth','superusuario'])->get('/producto/{id}','ProductoController@delete');
Route::middleware(['auth','superusuario'])->get('/producto/{id}/edit','ProductoController@edit');
Route::middleware(['auth','superusuario'])->post('/producto/{id}','ProductoController@update');

Route::middleware(['auth','superusuario'])->get('/producto/{id}/galeria','GaleriaController@index');
Route::middleware(['auth','superusuario'])->post('/imagen-p/{id}','GaleriaController@store');
Route::middleware(['auth','superusuario'])->get('/imagen-p/{id}','GaleriaController@delete');



Route::middleware('auth')->get('/carrito','PedidoController@carrito')->name('carrito');
Route::middleware('auth')->get('/carrito/{id}','PedidoController@delete');
Route::middleware('auth')->post('/pagar','PedidoController@pagar');

Route::middleware('auth')->get('/mis-compras','CompraController@misCompras');
Route::middleware('auth')->get('/compra/{id}','CompraController@compra');
Route::middleware(['auth','superusuario'])->get('/compra/{id}/verificar','CompraController@verificar');
Route::middleware(['auth','superusuario'])->get('/compra/{id}/enviar','CompraController@enviar');

Route::middleware(['auth','superusuario'])->get('/compras-sc','CompraController@comprassc');
Route::middleware(['auth','superusuario'])->get('/compras-pe','CompraController@compraspe');
Route::middleware(['auth','superusuario'])->get('/compras-e','CompraController@comprase');

Route::middleware('auth')->post('/cambiar-clave','PageController@password');