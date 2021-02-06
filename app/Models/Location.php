<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function provider()
    {
        return $this->belongsTo(User::class);
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class);
    }
}
