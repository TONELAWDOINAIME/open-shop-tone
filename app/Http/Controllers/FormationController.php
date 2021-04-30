<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        //$produits = Produit::all(); 
        //$produits = Produit::first(); 
        //$produits = Produit::where('id', 2)->get();  
        //$produits = Produit::where('prix', "<", 500000)->get();
        //$produits = Produit::where(["prix" => 500000, "quantite" => 30])->get();
       /* $produits = Produit::where("prix", "<", 500000)
        ->where("quantite", "!=", 50)
        ->get();        
        dd($produits);  */ 

        //  20210423 : test de la mise en relation entre Category (1) et (n) Produit. 
        $produit1 = Produit::first(); 

        //  20210423 : test de la mise en relation entre User (n) et (m) Produit. 
        $user1 = User::first(); 

        $user1->produits()->attach($produit1); 
        
        dd($produit1->users); 

        //$category1 = Category::first(); 
        //$produit1->category_id = $category1->id; 
        //$produit1->save(); 
        //dd($produit1->category); 

        dd($user1->produits); 
        
    }

    public function ajouterProduit()
    {
        $produit = new Produit(); 
            $produit->designation = "Maxwell"; 
            $produit->prix = 8000; 
            $produit->description = "Maxwell, c'est un super café !"; 
            $produit->quantite = 50; 
        $produit->save(); 
    }
    
    public function ajouterProduit2()
    {
        $produit = Produit::create([
            "designation" => "Ordinateur",  
            "prix" => 500000, 
            "description" => "La description de l'ordinateur", 
            "quantite" => 30, 
        ]);  

        dd($produit); 
    }

    public function updateProduit()
    {
        $produit1 = Produit::first(); 
            $produit1->designation = "Avovita"; 
            $produit1->prix = 1800; 
            $produit1->description = "Pommade féminine à base d'avocat"; 
            $produit1->quantite = 10; 
        $produit1->save(); 
        
        dd($produit1); 
    }

    //  Model Binding. 
    public function updateProduit2(Produit $produit)
    {
        
        $result = Produit::where("id", $produit->id)->update([
            "designation" => "Téléphone", 
            "prix" => 50000, 
            "description" => "Ceci est la description de téléphone", 
            "quantite" => 26 
        ]); 
        dd($produit->designation, $produit->quantite, $result); 
    }

    /*public function updateProduit2($id)
    {
        $produit2 = Produit::findOrFail($id); /*
            $produit1->designation = "Avovita"; 
            $produit1->prix = 1800; 
            $produit1->description = "Pommade féminine à base d'avocat"; 
            $produit1->quantite = 10; 
        $produit1->save(); * /
        
        dd($produit2); 
    }*/

    public function suppressionProduit()
    {
        //$result = Produit::where("id", $produit->id)->delete(); 
        $result = Produit::destroy(1);
        dd($result); 
    }
}
