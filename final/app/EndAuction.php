<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EndAuction extends Model
{
    public $timestamps  = false;
    public $table='endauction';
    protected $primaryKey= 'endauction_id';
    
    protected $fillable = [
        'status', 'id_auction','id_user',
    ];
    
    /**
     * The auction owner
     */
    public function user() {
        return $this->belongsTo('App\User','id_user', 'id_auction');
    }

    /**
     * Return id auction
     */
    public function auction() {
        return  $this->belongsTo('App\Auction','id_auction', 'id_user');
    }

}
