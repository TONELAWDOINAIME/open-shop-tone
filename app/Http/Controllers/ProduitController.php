<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use App\Mail\AjoutProduit;
use Illuminate\Http\Request;
use App\Exports\ProduitsExport;
use App\Notifications\ModifProduit;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\NouveauProduit;
use App\Http\Requests\ProduitFormRequest;

class ProduitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin'])->except(['index', 'show']); 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Récupère tous les produits. 
        //$produits = Produit::all(); 
        //  Récupère un nombre donné de produits. 
        //$produits = Produit::paginate(15); 
        $produits = Produit::orderByDesc('id')->paginate(15); 
        return view('front-office.produits.index', ['produits' => $produits]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  récupération des catégories. 
        $categories = Category::all(); 

        //  20210426 : Pour le partial _produit-form 
        $produit = new Produit; 

        return view("front-office.produits.create", compact('categories', 'produit')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //  20210426 : public function store(Request $request)
    public function store(ProduitFormRequest $request)
    {
        //  20210426 : validation des données. 
        //  On peut utiliser l'agent validator dans le cas du développement d'une API. 
        /*  20210426 : on déplace ce code de validation commun au request créé dans Http/Requests
        $request->validate([
            'designation' => 'required|min:3|max:50|unique:produits', 
            'prix' => 'required|numeric|between:1000,1000000', 
            'quantite' => 'required|numeric|between:5,5000', 
            'description' => 'nullable|max:255', 
            'category_id' => 'required|numeric', 
        ]); */
        
        //  20210426 : prise en compte d'une image. 
        $imageName = "produit.png"; 
        if ($request->file('image')) {
            //  20210426 : on renomme avec time()_ pour éviter l'écrasement. 
            $imageName = time()."_".$request->file('image')->getClientOriginalName(); 

            //  20210426 : stockage du fichier dans le storage/app/public/produits 
            //  le dossier de stockage par défaut est storage/app
            $request->file('image')->storeAs('public/produits', $imageName); 
        }

        $produit = Produit::create([
            'designation' => $request->designation, 
            'prix' => $request->prix, 
            'quantite' => $request->quantite, 
            'description' => $request->description, 
            'category_id' => $request->category_id, 
            'image' => $imageName, 
        ]); 
        
        //  20210429 : envoi de mail à un utilisateur 
        $user = User::first();  
        $produit = Produit::orderByDesc('id')->first(); 

        //  20210429 : pour l'envoi à plusieurs utilisateurs, Laravel propose la file d'attente
        Mail::to($user)->send(new AjoutProduit($produit)); 
        
        //  redirection vers les détails du produit ajouté.           
        return redirect()->route('produits.show', $produit)->with('statut', "Votre nouveau produit a été bien ajouté !"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        $produit = Produit::find($id); 
        return view("front-office.produits.show", compact('produit'));  
    }*/
    //  Par le Model Binding. 
    public function show(Produit $produit)
    {  
        return view("front-office.produits.show", compact('produit'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        //
    }*/
    //  Model Binding : on remplace $id par Produit $produit
    public function edit(Produit $produit)
    {
        $categories = Category::all(); 
        return view("front-office.produits.edit", compact('produit'), ['categories' => $categories]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProduitFormRequest $request, $id)
    {
        //  on lève l'unicité s'il s'agit de la même désignation : 
        //  'designation' => '...|unique:produits,designation,'.$id, 
        /*$request->validate([
            'designation' => 'required|min:3|max:50|unique:produits,designation,'.$id, 
            'prix' => 'required|numeric|between:1000,1000000', 
            'quantite' => 'required|numeric|between:5,5000', 
            'description' => 'nullable|max:255', 
            'category_id' => 'required|numeric', 
        ]);*/

        //  20210426 : prise en compte d'une image. 
        $imageName = "produit.png"; 
        if ($request->file('image')) {
            //  20210426 : on renomme avec time()_ pour éviter l'écrasement. 
            $imageName = time()."_".$request->file('image')->getClientOriginalName(); 

            //  20210426 : stockage du fichier dans le storage/app/public/produits 
            //  le dossier de stockage par défaut est storage/app
            $request->file('image')->storeAs('public/produits', $imageName); 
        } 
        
        Produit::where('id', $id)->update([
            'designation' => $request->designation, 
            'prix' => $request->prix, 
            'quantite' => $request->quantite, 
            'description' => $request->description, 
            'category_id' => $request->category_id, 
            'image' => $imageName, 
        ]); 
        
        //  20210429 : envoi de notification par mail
        $user = User::first(); 
        //$produit = Produit::orderByDesc('id')->first(); 
        $produit = Produit::find($id); 
        //$user->notify(new NouveauProduit($produit)); 
        $user->notify(new ModifProduit($produit)); 
        //  redirection vers les détails du produit modifié.           
        return redirect()->route('produits.show', $id)->with('statut', "Votre produit a bien été modifié !"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $produit = Produit::find($id); 
        Produit::destroy($id); 
        //  redirection vers la liste des produits.           
        return redirect()->route('produits.index')->with('statut', "Votre produit [ ".$produit->designation." ] a bien été supprimé !"); 
    }


    //  20210428 : Expotation en Excel avec composer require maatwebsite/excel
    public function export()
    {
        //  20210428 : exportation de tous les produits. 
        //  La classe ProduitsExport implémente une interface, alors les méthodes 
        //  de l'interface sont à impplémentées aux besoins.     
        return Excel::download(new ProduitsExport(), "produits.xlsx"); 
    }
}
