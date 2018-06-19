<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportUser extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  public $table='reportuser';
  protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason', 'id_userReporting', 'id_userReported', 
    ];

    protected $casts=[
        'id_userReporting'=>'integer',
        'id_userReported'=>'integer',
        'reason'=>'string',
    ];
}