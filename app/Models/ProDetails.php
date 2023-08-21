<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProDetails extends Model
{
    use HasFactory;
    protected $table = 'pro_details';
    public $timestamps = false;
    protected $attributes = [
        'memory'=>null,
        'camera'=>null,
        'display'=>null,
        'batery'=>null,
        'os'=>null,
        'sub_camera'=>null,
        'cpu'=>null,
        'ram'=>null,
        'hight'=>null,
        'width'=>null,
        'depth'=>null,
        'weight'=>null
    ];
    protected $fillable = [
        'pro_id','memory','camera','display','batery','os','sub_camera','cpu','ram','hight','width','depth','weight'
    ];

    public function Products()
    {
        return $this->belongsTo('App\Models\Products','pro_id','id');
    }
}
