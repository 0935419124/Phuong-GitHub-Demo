<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primary = 'id';
    protected $date= 'time';
    protected $attributes = [

        'rate'=> 0
    ];
    protected $fillable = [
        'pro_id ','user_id','content','rate','time','status'
    ];
    public function Products()
    {
        return $this-> belongsTo('App\Models\Products','pro_id','id');
    }
    public function Users()
    {
        return $this-> belongsTo('App\Models\User','user_id','id');
    }
}
