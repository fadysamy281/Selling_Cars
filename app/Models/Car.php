<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Car extends Model
{
    use HasFactory;
    protected $table="cars";
    protected $fillable=['name','description','color','owner_id',
                        'quantity','unit_price','photo'];
    
    
    public function owner(){
        return $this->belongsTo('User::class','owner_id','id');
    }
    
    
    
}
