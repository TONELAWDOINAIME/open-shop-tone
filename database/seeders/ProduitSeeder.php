<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$produit = Produit::create([
            'designation' => "Chemise", 
            'prix' => 5000, 
            'description' => "Ceci est la description de chemise", 
            'quantite' => 50, 
        ]); */
        //  Appel du factory dans ProduitSeeder qui est lui même appelé dans DatabaseSeeder. 
        Produit::factory(500)->create(); 
    }
}
