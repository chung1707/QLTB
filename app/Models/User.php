<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Info;
use App\Models\Role;
use App\Models\Exportbill;
use App\Models\Importbill;
use App\Models\HistoryRestoreEquipment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function importbills(){
        return $this->hasMany(Importbill::class);
    }
    public function cart(){
        return $this->hasOne(Cart::class);
    }
    public function exportbills(){
        return $this->hasMany(Exportbill::class);
    }
    public function info(){
        return $this->hasOne(Info::class);
    }
    public function historyRestoreEquipments(){
        return $this->hasMany(HistoryRestoreEquipment::class);
    }
}
