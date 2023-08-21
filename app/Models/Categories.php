<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primary = 'id';
    public $timestamps = false;
    protected $attributes = [
        'image'=>''
    ];
    protected $fillable = [
        'name',
        'image'
    ];
    public function Cate_items()
    {
        return $this-> hasMany('App\Models\CateItems','cate_id','id');
    }
    public function Products()
    {
        return $this-> hasManyThrough('App\Models\Products','App\Models\CateItems','cate_id','cate_id','id','id');
    }
}
