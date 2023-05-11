<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'default',
        'metadata',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'metadata' => 'json',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'default' => 'boolean',
    ];

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
