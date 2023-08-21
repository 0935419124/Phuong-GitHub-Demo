<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table='images_product';
    public $timestamps= false;
    protected $fillable=[
        'pro_id',
        'image'
    ];

    public function Product()
    {
        return $this->belongsTo('App\Models\Categories','pro_id','id');
    }
}
