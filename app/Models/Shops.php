<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'phonenumber',
        'is_verified', 
        'status',
    ];

    public function adminVerifications()
    {
        return $this->hasMany(AdminVerification::class);
    }
}
