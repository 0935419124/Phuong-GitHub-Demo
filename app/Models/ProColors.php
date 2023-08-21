<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProColors extends Model
{
    use HasFactory;
    protected $table = 'pro_colors';
    protected $primary = 'id';
    public $timestamps= false;
    protected $attributes=[
        'price'=>null
    ];
    protected $fillable=[
        'pro_id','color','image','price'
    ];

    public function Products()
    {
        return $this->belongsTo('App\Models\Products','pro_id','id');
    }
}
