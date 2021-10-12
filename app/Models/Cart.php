<?php

namespace App\Models;

use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];
    public function equipments(){
        return $this->belongsToMany(Equipment::class)->withPivot('quantity','newPrice');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
