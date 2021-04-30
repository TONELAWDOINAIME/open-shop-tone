<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AjoutProduit extends Mailable
{
    use Queueable, SerializesModels; 

    //  20210429 : accès à la classe Produit
    public $produit; 


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($produit)
    {
        $this->produit = $produit; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Un nouveau produit sur OpenShom")
        ->from(env('APP_MAIL_FROM'))
        ->markdown('emails.produits.ajout-produit');
    }
}
