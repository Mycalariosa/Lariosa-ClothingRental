<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalApp extends Model
{
    use HasFactory;

    protected $table = 'rental_apps';

    protected $primaryKey = 'rental_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'clothes_id',
        'rental_date',
        'return_date',
        'payment_method',
        'total_payment',
        'rental_status_id',
    ];

    // Optional: define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clothes()
    {
        return $this->belongsTo(Clothes::class);
    }

    public function rentalStatus()
    {
        return $this->belongsTo(RentalStat::class, 'rental_status_id');
    }
}
