<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class PaypalPayment extends Model
{
    public function username()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
