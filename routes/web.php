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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::name('produits.show')->get('produits/{produit}', 'ProductController');

Route::resource('panier', 'CartController')->only(['index', 'store', 'update', 'destroy']);

// Utilisateur authentifié
Route::middleware('auth')->group(function () {
  // Commandes
  Route::prefix('commandes')->group(function () {
  	  Route::name('commandes.details')->post('details', 'DetailsController');
      Route::resource('/', 'OrderController')->names([
          'create' => 'commandes.create',
          'store' => 'commandes.store',
      ])->only(['create', 'store']);
      Route::name('commandes.confirmation')->get('confirmation/{order}', 'OrdersController@confirmation');
  });
});