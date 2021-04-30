<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageColumnOnProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  20210426 : ajout d'une colonne image dans la table produit 
        //  au lieud de Schema::create on fait Schema::table
        Schema::table("produits", function(Blueprint $table) {
            $table->string('image')->nullable(); 
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("produits", function(Blueprint $table) {
            $table->dropColumn('image'); 
        }); 
    }
}
