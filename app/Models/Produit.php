<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    public $fillable = [
        'designation', 
        'prix', 
        'description', 
        'quantite', 
        'category_id', 
        'image', 
    ]; 
    
    use HasFactory;  

    //  Création de la relation entre Category (1) et (n) Produit. 
    public function category() 
    {
        return $this->belongsTo(Category::class); 
    }

    //  Création de la relation entre User (n) et (m) Produit. 
    public function users()
    {
        return $this->belongsToMany(User::class); 
    }
}
