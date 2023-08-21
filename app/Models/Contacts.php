<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $primary = 'id';

    protected $fillable = [
        'id_user','user_email', 'user_name','message'
    ];
    public function Users()
    {
        return $this-> belongsTo('App\Models\User','user_id','id');
    }
}
