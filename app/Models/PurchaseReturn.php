<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseReturnDetails;
use App\Models\supplier;
use App\User;

class PurchaseReturn extends Model
{
    public function SupplierName()
    {
        return $this->belongsto(supplier::class, 'supplier_id', 'id');
    }
    public function PDetails()
    {
        return $this->hasMany(PurchaseReturnDetails::class,'return_id');
    }
    public function username()
    {
        return $this->belongsto(User::class,'user_id');
    }
}
