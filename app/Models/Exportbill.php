<?php

namespace App\Models;

use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exportbill extends Model
{
    use HasFactory;
    public function equipments(){
        return $this->belongsToMany(Equipment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
