<?php

namespace App\Models;

use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Importbill extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','total_price','supplier_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function equipments(){
        return $this->belongsToMany(Equipment::class);
    }
}
