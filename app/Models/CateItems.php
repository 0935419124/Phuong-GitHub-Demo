<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateItems extends Model
{
    use HasFactory;
    protected $table = 'cate_items';
    protected $primary = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'image',
        'cate_id'
    ];

    public function Categories()
    {
        return $this->belongsTo('App\Models\Categories','cate_id','id');
    }
    public function Products()
    {
        return $this->hasMany('App\Models\Products','cate_id','id');
    }
}
