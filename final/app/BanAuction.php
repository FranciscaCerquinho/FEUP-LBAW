<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanAuction extends Model
{
    public $timestamps  = false;
    public $table='banauction';

    protected $primaryKey= 'id';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_auction', 'date',
    ];


}
