<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\purchase;
use App\User;
class PurchaseRecieved extends Model
{
    public function purchaseDetails()
    {
        return $this->belongsTo(purchase::class, 'purchase_id');
    }

    public function username()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
