<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\WastageDetails;
class Wastage extends Model
{
    
    public function WDatils()
    {
        return $this->hasMany(WastageDetails::class);
    }
    public function username()
    {
        return $this->belongsto(User::class, 'user_id');
    }
}
