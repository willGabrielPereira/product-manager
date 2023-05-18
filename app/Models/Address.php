<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPrincipal;

class Address extends Model
{
    use HasFactory, HasPrincipal;

    protected static $principalOver = 'user_id';

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
        'principal',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'latitude' => 'double',
        'longitude' => 'double',
        'principal' => 'boolean',
    ];

    public function user() {
        $this->belongsTo(User::class, 'user_id');
    }
}
