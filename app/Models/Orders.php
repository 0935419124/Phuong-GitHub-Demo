<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primary = 'id';
    public $timestamps = true;
    protected $attributes = [
        'status'=>0,
        'note'=>''
    ];
    protected $fillable = [
        'user_id ','user_address','deli_id','discount','total','status','note'
    ];

    public function OrderDetails()
    {
        return $this->hasMany('App\Models\OrderDetails','order_id', 'id');
    }
    public function Products()
    {
        return $this->hasMany('App\Models\Products','pro_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function UserAddress()
    {
        return $this->belongsTo('App\Models\UserAddress','user_address','id');
    }
    public function Delivery()
    {
        return $this->belongsTo('App\Models\Delivery','deli_id', 'id');
    }
}
