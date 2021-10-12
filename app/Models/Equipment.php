<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Sellbill;
use App\Models\Supplier;
use App\Models\Exportbill;
use App\Models\Importbill;
use App\Models\Equipment_Used;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','quantity','description','device_code','supplier_id','category_id'];
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function importbills(){
        return $this->belongsToMany(Importbill::class);
    }
    public function equipment_used(){
        return $this->hasMany(Equipment_Used::class);
    }
    public function carts(){
        return $this->belongsToMany(Cart::class);
    }
    public function sellbills(){
        return $this->belongsToMany(Sellbill::class);
    }
    public function exportbills(){
        return $this->belongsToMany(Exportbill::class);
    }
}
