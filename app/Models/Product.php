<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    const ACTIVE = 1;

    const DEACTIVE = 0;

    protected $fillable = [
        'category',
        'title',
        'slug',
        'price',
        'description',
        'image',
        'status',
        'created_by'
    ];

    protected function getPriceAttribute($price)
    {
        return "Rp " . number_format($price, 2, ',', '.');
    }

    protected function getImageAttribute($image)
    {
        return url('storage/' . $image);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
