<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportAuction extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  public $table='reportauction';
  protected $primaryKey = ['id_auction','id_user'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason', 'id_auction', 'id_user', 
    ];

}