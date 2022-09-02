<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExpensesType;
use App\User;
class Expenses extends Model
{
    public function ExpnensesType(){
        return $this->belongsto(ExpensesType::class,'expenses_id');
       
    }
    
    public function username(){
        return $this->belongsto(User::class,'user_id');
    }

}
