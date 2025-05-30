<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_status_id'; // Set the custom primary key

    protected $fillable = [
        'id',
        'status'
    ];
    public $timestamps = true;

    /**
     * Define relationship with User.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
