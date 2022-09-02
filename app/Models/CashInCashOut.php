<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class CashInCashOut extends Model
{
    public function username(){
        return $this->belongsto(User::class,'user_id');
    }
}
