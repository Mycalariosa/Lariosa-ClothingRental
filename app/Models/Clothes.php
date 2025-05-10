<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    protected $table = 'clothes';

    protected $fillable = [
        'brand',
        'category',
        'size',
        'price',
        'color',
        'material',
        'description',
    ];
}
