<?php

use App\Models\Produit;
use App\Mail\AjoutProduit;
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

//  20210428    Application de groupes de middleware 

//  Page d'accueil 
Route::get('/', [MainController::class, "accueil"])->name('accueil'); 

//  
Route::middleware(['auth', 'isAdmin'])->group(function () {

    //  Gestion des produits. 
    //  index et show ne doivent pas être protégées 
    //  on agit dans ProduitController
    //Route::resource('produits', ProduitController::class); 

}); 

//  Gestion des produits. 
//  index et show ne doivent pas être protégées 
//  on agit dans ProduitController
Route::resource('produits', ProduitController::class); 


//  cas pratique Open-Shop          20210421

Route::get('/', [MainController::class, "accueil"])->middleware(['auth', 'isAdmin'])->name('accueil'); 

//  Gestion des produits. 
Route::resource('produits', ProduitController::class); 

 //  au lieu d'utiliser le type resource. 
Route::get('index', [FormationController::class, "index"]); 


//  20210427 : Système d'authentification utilisateur 
//  Routes ajoutées par breeze 

//  20210427 : retiré pour accueil
/*Route::get('/', function () {
    return view('welcome');
});*/

//  20210428 : Exportation en Excel avec composer require maatwebsite/excel 
//  la méthode export() est dans ProduitController.php 
//  Dans ProduitController.php, on passe en paramètres : 
//      - new ProduitsExport() 
//      - "produits.xlsx" comme le titre du fichier excel à générer
Route::get('export', [ProduitController::class, "export"])->name('export'); 

//  20210429 : Notification par mail
Route::get('test-mail', function () { 
    return new AjoutProduit(Produit::orderByDesc('id')->first()); 
}); 

//  20210429 : Notification par SMS
Route::get('test-sms', function () { 
    return new AjoutProduit(Produit::orderByDesc('id')->first()); 
}); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//  20210427 : __DIR__ contient l'ensemble des routes du système d'authentification
require __DIR__.'/auth.php'; 
