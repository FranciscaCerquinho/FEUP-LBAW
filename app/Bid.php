<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public $timestamps  = false;
    public $table='bid';
    protected $primaryKey= 'id';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'price', 'date', 'id_auction', 'id_user', 
    ];


}
