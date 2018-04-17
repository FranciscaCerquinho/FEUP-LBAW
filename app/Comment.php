<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  public $table='comment';
  
     /**
     * Get the auction comment.
     */
    public function auction()
    {
        return $this->belongsTo('App\Auction');
    }
}