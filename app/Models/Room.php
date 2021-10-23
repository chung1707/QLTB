<?php

namespace App\Models;

use App\Models\Exportbill;
use App\Models\Equipment_Used;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    public function equipmentUseds(){
        return $this->hasMany(Equipment_Used::class);
    }
    public function exportBills(){
        return $this->hasMany(Exportbill::class);
    }
}
