<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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


    // REGION - RELATIONSHIPS
    
    /**
     * The games that this user has saved
     */
    public function games()
    {
        return $this->belongsToMany('App\Models\Game', 'user_game', 'user_id', 'game_id');
    }

    /**
     * The highlights that this user has saved
     */
    public function highlights()
    {
        return $this->belongsToMany('App\Models\Highlight', 'user_highlight', 'user_id', 'highlight_id');
    }

    // END REGION
}
