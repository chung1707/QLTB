<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Room;
use App\Models\SellCart;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment_Used extends Model
{
    use HasFactory;
    protected $fillable= ['equipment_id','area_id','room_id','status','note','quantity'];
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
    public function area(){
        return $this->belongsTo(Area::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
