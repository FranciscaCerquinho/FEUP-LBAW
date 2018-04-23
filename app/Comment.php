<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  public $table='comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'like', 'dislike', 'date', 'comment', 'id_user', 'id_auction',
    ];

    /**
     * Get the auction comment.
     */
    public function auction()
    {
        return $this->belongsTo('App\Auction');
    }


    /**
     * Get the auction comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }

   
}