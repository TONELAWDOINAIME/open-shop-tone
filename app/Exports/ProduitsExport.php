<?php

namespace App\Exports;

use App\Models\Produit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProduitsExport implements /*FromCollection, */FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        //  20210428 : exportation de tous les produits en collection. 
        //  La classe ProduitsExport implémente une interface, alors les méthodes 
        //  de l'interface sont à impplémentées aux besoins.  
        return Produit::all(); 
    }*/

    //  20210428 : exportation d'une vue
    //  use Illuminate\Contracts\View\View;
    public function view(): View
    {
        return view('partials._produits-table', ['listProduits' => Produit::all(), 'n' => 0]); 
    }
}
