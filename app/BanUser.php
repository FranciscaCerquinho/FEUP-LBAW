<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BanUser extends Model
{
    public $timestamps  = false;
    public $table='banuser';

    protected $primaryKey= 'id';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_admin', 'date',
    ];


}
