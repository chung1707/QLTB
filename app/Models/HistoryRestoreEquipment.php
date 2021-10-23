<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRestoreEquipment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'room_id', 'quantity', 'area_id', 'equipment_id',];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
