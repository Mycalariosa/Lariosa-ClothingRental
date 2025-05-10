<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalStat extends Model
{
    use HasFactory;

    protected $table = 'rental_stats'; // Optional, but good practice

    protected $primaryKey = 'rental_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'rental_status',
    ];
}
