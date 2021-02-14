<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
        'lots' => 'integer',
        'isInitialPlan' => 'boolean',
        'isBanningPlan' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
