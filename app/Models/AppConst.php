<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConst extends Model
{
    use HasFactory;
    const DEFAULT_PER_PAGE = 10;
    const RANDOM_CODE = 7;
}
