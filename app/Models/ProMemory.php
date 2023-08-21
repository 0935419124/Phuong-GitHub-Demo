<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProMemory extends Model
{
    use HasFactory;
    protected $table = 'pro_memory';
    protected $primary = 'id';
    public $timestamps= false;
    protected $attributes=[
        'price'=>null
    ];
    protected $fillable=[
        'pro_id','memory','ram','price'
    ];

    public function Products()
    {
        return $this->belongsTo('App\Models\Products','pro_id','id');
    }
}
