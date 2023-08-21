<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primary = 'id';
    // protected $dates = 'date';
    public $timestamps = false;
    protected $fillable = [
        'order_id','product_id ','product_name','number','price'
    ];

    public function Orders()
    {
        return $this->belongsTo('App\Models\Orders','order_id','id');
    }
    public function Products()
    {
        return $this->belongsTo('App\Models\Products','product_id', 'id');
    } 

    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }
}
