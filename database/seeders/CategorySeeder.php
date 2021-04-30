<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'libelle' => "Matériels Electronique", 
            'description' => "Ceci est la description de Matériels Electroniques", 
        ]); 

        Category::create([
            'libelle' => "Vêtements", 
            'description' => "Ceci est la description de Vêtements", 
        ]); 

        Category::create([
            'libelle' => "Cosmétiques", 
            'description' => "Ceci est la description de Cosmétiques", 
        ]);
    }
}
