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

Route::get('/', function () {
	return redirect('/vendas');
});

Route::group(['prefix' => 'categorias'], function(){
	Route::get('/', 'CategoriaController@index');
	Route::get('/new', 'CategoriaController@new');
	Route::get('/edit/{id}', 'CategoriaController@edit');

	Route::delete('/delete/{id}', 'CategoriaController@delete');
	Route::post('/save', 'CategoriaController@save');
	Route::post('/update', 'CategoriaController@update');
});

Route::group(['prefix' => 'produtos'], function(){
	Route::get('/', 'ProdutoController@index');
	Route::get('/new', 'ProdutoController@new');
	Route::get('/edit/{id}', 'ProdutoController@edit');

	Route::delete('/delete/{id}', 'ProdutoController@delete');
	Route::post('/save', 'ProdutoController@save');
	Route::post('/update', 'ProdutoController@update');
});

Route::group(['prefix' => 'cidades'], function(){
	Route::get('/', 'CidadeController@index');
	Route::get('/new', 'CidadeController@new');
	Route::get('/edit/{id}', 'CidadeController@edit');
	Route::delete('/delete/{id}', 'CidadeController@delete');
	Route::post('/save', 'CidadeController@save');
	Route::post('/update', 'CidadeController@update');
});

Route::group(['prefix' => 'clientes'], function(){
	Route::get('/', 'ClienteController@index');
	Route::get('/new', 'ClienteController@new');
	Route::get('/edit/{id}', 'ClienteController@edit');
	Route::delete('/delete/{id}', 'ClienteController@delete');
	Route::post('/save', 'ClienteController@save');
	Route::post('/update', 'ClienteController@update');
});

Route::group(['prefix' => 'emitente'], function(){
	Route::get('/', 'EmitenteController@index');
	Route::post('/save', 'EmitenteController@save');
});

Route::group(['prefix' => 'vendas'], function(){
	Route::get('/', 'VendaController@index');
	Route::get('/new', 'VendaController@new');
	Route::get('/show/{id}', 'VendaController@show');
	Route::post('/save', 'VendaController@save');
});

Route::group(['prefix' => 'notafiscal'], function(){
	Route::get('/gerarXml/{id}', 'NotaFiscalController@gerarXml');
	Route::post('/transmitir', 'NotaFiscalController@transmitir');

	Route::get('/imprimir/{id}', 'NotaFiscalController@imprimir');
	Route::get('/imprimirSimples/{id}', 'NotaFiscalController@imprimirSimples');
	Route::get('/imprimirCorrecao/{id}', 'NotaFiscalController@imprimirCorrecao');
	Route::get('/imprimirCancelamento/{id}', 'NotaFiscalController@imprimirCancelamento');

	Route::get('/download/{id}', 'NotaFiscalController@download');

	Route::post('/cartaCorrecao', 'NotaFiscalController@cartaCorrecao');
	Route::post('/cancenlarNFe', 'NotaFiscalController@cancenlarNFe');


});

