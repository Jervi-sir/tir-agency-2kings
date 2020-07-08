<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany('App\Reservation');     //user can do many order //select * from order where user_id = $user->id
    }

    // if panier is added  [*********mazal ma 3reft how********]
    // public function paniers()
    // {
    //     return $this->hasMany(Panier::class); //select * fron patiner where user_id = user
    // }

    public function role()
    {
        return $this->belongsTo('App\Role');        //depend on User existance table
    } 


    public function rendezVouz() 
    {
        return $this->hasMany('App\OmraRendezVous');        //hotel has many chambres
    } 



}
