<?php

namespace App\Models;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'reference',
        'title',
        'content',
        'more_info',
        'price',
        'amount',
        'dimensions',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'price' => 'double',
        'amount' => 'double',
        'dimensions' => 'json',
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_product');
    }
}
