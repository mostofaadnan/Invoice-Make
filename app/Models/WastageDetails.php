<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class WastageDetails extends Model
{
    public function productName()
    {
        return $this->belongsto(Product::class, 'item_id');
    }
 
    public function username()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
