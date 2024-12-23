<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminVerification extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id'];

    public function store()
    {
        return $this->belongsTo(Shops::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
