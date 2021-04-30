<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Produit;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function accueil () 
    {   
        $user = User::orderByDesc('id')->first(); 
        //  Plus besoin de faire : $role = Role::where('id', $user->role_id)->get(); 
        //  $user->role récupère tout dans la table Roles 
        //dd($user->isAdmin()); 
        
        //  20210427 : Collections. 
        /*
        $collect1 = collect(['Orange', 'Banane', 'Avocat', 'Mangue',]); 
        $produits = Produit::all(); 
        $produitsFiltres = $produits->filter(function($produit, $key) {
            return ($produit->prix > 100000 && $produit->prix < 500000); 
        }); dd($produitsFiltres); */
       //dd($collect2->filter_has_var(500, 'prix');  
        
        //  Récupération des 08 derniers produits 
        //  on change l'ordre suivant l'id 
        //  on fait un take() ou un limit()
        $produits = Produit::orderByDesc('id')->take(8)->get(); 
        return view("welcome", ['produits' => $produits]); 
    }
}
