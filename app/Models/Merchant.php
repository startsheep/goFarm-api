<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'merchant_name',
        'description',
        'image',
        'location_point',
        'address',
    ];

    public function getImageAttribute($image)
    {
        return url('storage/'.$image);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
