<?php

namespace App\Models;

use App\Models\Equipment;
use App\Models\Importbill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Supplier extends Model
{
    use HasFactory;

    public function equiqments(){
        return $this->hasMany(Equipment::class);
    }
    public function importbills(){
        return $this->hasMany(Importbill::class);
    }
}
