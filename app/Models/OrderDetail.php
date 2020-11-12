<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="order_details";
    protected $fillable = [
        'order_id', 'car_id', 'quantity', 'total_price', 
    ];
        pubic function owner(){
        return $this->belongsTo('User::class','user_id','id');
    }
}
