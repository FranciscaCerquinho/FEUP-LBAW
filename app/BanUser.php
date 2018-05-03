<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
