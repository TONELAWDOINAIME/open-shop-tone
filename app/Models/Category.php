<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    public $fillable = [
        'libelle', 
        'description',
    ]; 

    use HasFactory; 

    //  Création de la relation entre Category (1) et (n) Produit. 
    public function produits()
    {
        return $this->hasMany(Produit::class); 
    }
}
