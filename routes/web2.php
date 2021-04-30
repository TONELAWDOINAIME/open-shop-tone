<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FormationController;

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

//  cas pratique Open-Shop          20210421
Route::get('/', [MainController::class, "accueil"])->name('accueil'); 

//  Gestion des produits. 
Route::resource('produits', ProduitController::class); 

 //  au lieu d'utiliser le type resource. 
Route::get('index', [FormationController::class, "index"]); 
/*Route::get('update-produit', [FormationController::class, "updateProduit"]); 
//Route::get('update-produit-2/{id}', [FormationController::class, "updateProduit2"]); 
//  Model Binding.
Route::get('update-produit-2/{produit}', [FormationController::class, "updateProduit2"]); 
Route::get('ajouter-produit', [FormationController::class, "ajouterProduit"]); 
Route::get('ajouter-produit-2', [FormationController::class, "ajouterProduit2"]); 
Route::get('suppression-produit', [FormationController::class, "suppressionProduit"]); 

//  Gestion des produits. 
Route::resource('produits', ProduitController::class); */

