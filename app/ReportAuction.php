<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportAuction extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  public $table='reportauction';

  protected $casts=[
    'id_user'=>'integer',
    'id_auction'=>'integer',
    'reason'=>'string',
  ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason', 'id_auction', 'id_user', 
    ];

}