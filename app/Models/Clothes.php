<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    protected $table = 'clothes'; // Optional: specify table name if it doesn't match the model name

    protected $primaryKey = 'clothes_id'; // Set the custom primary key

    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'brand',
        'category',
        'size',
        'price',
        'color',
        'material',
        'description',
    ];

    /**
     * Define relationship with RentalApp.
     */
    public function rentals()
    {
        return $this->hasMany(RentalApp::class, 'clothes_id');
    }
}
