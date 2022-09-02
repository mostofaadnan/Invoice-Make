<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\unit;
use App\Models\VatSetting;
use App\User;

class Product extends Model
{


    public function CategoryName()
    {
        return $this->belongsto(Category::class, 'category_id');
    }
    public function SubcategoryName()
    {
        return $this->belongsto(Subcategory::class, 'subcategory_id');
    }
    public function BrandName()
    {
        return $this->belongsto(Brand::class, 'brand_id');
    }
    public function UnitName()
    {

        return $this->belongsto(unit::class,'unit_id');
    }
    public function VatName()
    {
        return $this->belongsto(VatSetting::class, 'VatSetting_id', 'id');
    }
    public function username()
    {
        return $this->belongsto(User::class, 'admin_id');
    }
    public function openingStock()
    {
        return $this->hasMany(OpeningStock::class, 'product_id');
     
    }
    public function QuantityOutBySale()
    {
        return $this->hasMany(InvoiceDetails::class, 'item_id')
            ->where('cancel', 0);
           
    }
    public function QuantityOutByPurchase()
    {
        return $this->hasMany(purchasedetails::class, 'itemcode')
            ->where('status', '1');
       
    }
    public function QuantityOutBySaleReturn()
    {
        return $this->hasMany(SaleReturnDetails::class, 'item_id');
            
    }
    public function QuantityOutByPurchaseReturn()
    {
        return $this->hasMany(PurchaseReturnDetails::class, 'itemcode');
           
    }
}
