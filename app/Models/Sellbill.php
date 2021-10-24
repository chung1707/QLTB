<?php

namespace App\Models;

use App\Models\DeletedEquipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sellbill extends Model
{
    use HasFactory;
    protected $fillable = ['client', 'phone', 'totalPrice'];
    public function deletedEquipments(){
        return $this->belongsToMany(DeletedEquipment::class)->withPivot('quantity','price');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
