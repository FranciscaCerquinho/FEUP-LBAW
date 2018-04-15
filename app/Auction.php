<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  public $table='auction';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'dateBegin','dateEnd', 'name', 'description','actualPrice','photo','buyNow','active',
    ];

  /**
   * The user this card belongs to
   */
  public function user() {
    return $this->belongsTo('App\User','id_user');
  }

  /**
   * The card this item belongs to.
   */
  public function card() {
    return $this->belongsTo('App\Card');
  }
}
