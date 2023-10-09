<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }   
}
