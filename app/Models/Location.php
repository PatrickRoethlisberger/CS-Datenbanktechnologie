<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_user_id',
        'description',
        'streetname',
        'streetnumber',
        'plz',
        'city',
        'IBAN',
        'checks',
        'roles'
    ];

    public function provider()
    {
        return $this->belongsTo(User::class);
    }
}
