<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class VatCollection extends Model
{
    public function username()
    {
        return $this->belongsto(User::class, 'user_id');
    }
    public function InvDetails(){
        return $this->hasMany(Invoice::class,'vatcollection_id');
    }
}
