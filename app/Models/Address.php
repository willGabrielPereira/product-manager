<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'phone',
        'zipcode',
        'number',
        'complement',
        'street',
        'city',
        'district',
        'state',
        'country',
        'latitude',
        'longitude',
        'default',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'latitude' => 'double',
        'longitude' => 'double',
        'default' => 'boolean',
    ];

    public function user() {
        $this->belongsTo(User::class, 'user_id');
    }
}
