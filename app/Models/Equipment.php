<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Importbill;
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
}
