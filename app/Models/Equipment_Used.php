<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment_Used extends Model
{
    use HasFactory;
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}