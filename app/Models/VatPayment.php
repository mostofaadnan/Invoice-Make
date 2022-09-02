<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class VatPayment extends Model
{
    public function Vat_Collection()
    {
        return $this->belongsto(VatCollection::class, 'vat_id');
    }
    public function username()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}