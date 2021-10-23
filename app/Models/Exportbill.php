<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Room;
use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exportbill extends Model
{
    use HasFactory;
    public function equipments(){
        return $this->belongsToMany(Equipment::class)->withPivot('quantity');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function area(){
        return $this->belongsTo(Area::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
