<?php

namespace App\Models;

use App\Models\Exportbill;
use App\Models\Equipment_Used;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;
    public function exportbills(){
        return $this->HasMany(Exportbill::class);
    }
    public function equipmentuseds(){
        return $this->HasMany(Equipment_Used::class);
    }
}
