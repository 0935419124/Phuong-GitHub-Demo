<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
   // protected $primary = 'id';
   // protected $dates = ['date'];
    public $timestamps = true;
    protected $attributes = [
        'image'=>'',
        'discount'=>0,
        'hot'=> 0,
        'view'=> 0,
        'status'=>0
    ];
    protected $fillable = [
        'name','cate_id','price','discount','image','date','view','quantity','detail','hot','status'
    ];

    public function Categories()
    {
        return $this->belongsTo('App\Models\Categories','cate_id','id');
    }
    public function Cate_items()
    {
        return $this->belongsTo('App\Models\CateItems','cate_id','id');
    }
    public function Comments()
    {
        return $this-> hasMany('App\Models\Comments','pro_id','id');
    }
    public function ProDetails()
    {
        return $this-> hasOne('App\Models\ProDetails','pro_id','id');
    }
    public function ProColors()
    {
        return $this-> hasMany('App\Models\ProColors','pro_id','id');
    }
    public function ProMemory()
    {
        return $this-> hasMany('App\Models\ProMemory','pro_id','id');
    }
    public function ProVariants()
    {
        return $this-> hasMany('App\Models\ProVariants','pro_id','id');
    }
    public function Images()
    {
        return $this-> hasMany('App\Models\Images','pro_id','id');
    }
}
