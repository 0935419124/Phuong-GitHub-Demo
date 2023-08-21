<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table='delivery';
    public $timestamps= false;
    protected $fillable=[
        'value',
        'name'
    ];

    public function Orders()
    {
        return $this->belongsTo('App\Models\Orders','deli_id','id');
    }
}
