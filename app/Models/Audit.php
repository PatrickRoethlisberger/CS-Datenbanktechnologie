<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
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
        'date' => 'datetime',
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_user_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_user_id', 'id');
    }
}
