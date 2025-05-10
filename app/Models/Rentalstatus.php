<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'rentals';

    protected $fillable = [
        'user_id',
        'clothes_id',
        'rental_date',
        'rental_return_date',
        'payment_method',
        'total_payment',
        'rentalstatus_id',
    ];
}
