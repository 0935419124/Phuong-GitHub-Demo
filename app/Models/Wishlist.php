<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';
    protected $primary = 'id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'pro_id',
    ];
    public function products()
    {
        return $this->belongsTo('App\Models\Products','pro_id','id');
    }
    public function users()
    {
        return $this->belongTo('App\Models\User','user_id','id');
    }
}
