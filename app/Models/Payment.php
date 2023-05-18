<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPrincipal;

class Payment extends Model
{
    use HasFactory, HasPrincipal;

    protected static $principalOver = 'user_id';

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'principal',
        'metadata',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'metadata' => 'json',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'principal' => 'boolean',
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
