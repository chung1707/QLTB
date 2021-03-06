<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Info extends Model
{
    use HasFactory;
    protected $table = 'hosonhansu';
    protected $primaryKey  = 'MaNV';
    public $incrementing = false;

    public function user(){
        return $this->belongsTo(User::class,'employee_id');
    }
}
