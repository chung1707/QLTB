<?php

namespace App\Models;

use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeletedEquipment extends Model
{
    use HasFactory;
    protected $fillable = ['equipment_id', 'quantity', 'note'];
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
