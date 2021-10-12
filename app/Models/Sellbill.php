<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sellbill extends Model
{
    use HasFactory;
    public function equipments(){
        return $this->belongsToMany(Equipment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
