<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\supplier;
use App\User;
class SupplierPayment extends Model
{
    public function SupplierName()
    {
        return $this->belongsto(supplier::class, 'supplier_id');
    }
    public function username()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
