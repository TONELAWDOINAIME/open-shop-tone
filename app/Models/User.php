<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password', 
        'role_id', 
        'phone_number', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; 

    //  Création de la relation entre User (n) et (m) Produit. 
    public function produits()
    {
        return $this->belongsToMany(Produit::class); 
    }

    //  20210427 : Création de la relation entre Role (1) et (n) User. 
    public function role() 
    {
        return $this->belongsTo(Role::class); 
    }


    //  20210427 : Vérification du profil de l'utilisateur connecté. 
    public function isAdmin()
    {
        /*if ($this->role->profil == "super-admin" OR $this->role->profil == "admin") {
            return true; 
        } else {
            return false; 
        } */
        return ($this->role->profil == "super-admin" OR $this->role->profil == "admin");  
        //  return ($this->role->profil == "super-admin" OR $this->role->profil == "admin") ?? false; 
    }

    //  20210429 : envoi de notification par SMS
    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number;
    }
}
