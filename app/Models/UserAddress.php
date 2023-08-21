<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $primary = 'id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'role'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
