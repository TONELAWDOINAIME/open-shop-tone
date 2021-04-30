<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class NouveauProduit extends Notification
{
    use Queueable; 

    //  20210429 : envoi de notification par mail
    public $produit; 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($produit)
    {
        $this->produit = $produit; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //  20210429 : notification par défaut par mail 
        //  sinon ['mail', 'sms', ...]
        return ['mail', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //  méthode 1 : par compact
        /*$produit = $this->produit; 
        return (new MailMessage)->markdown('notifications.produits.nouveau-produit', compact('produit'));*/
        
        //  méthode 2 : par un tableau
        return (new MailMessage)->markdown('notifications.produits.nouveau-produit', ['produit' => $this->produit]);
    }

    //  20210429 : envoi de notificationn par SMS
    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content("Bonjour ! Le produit ".$this->produit->designation." vient d'être modifié sur OpenShop !");
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
