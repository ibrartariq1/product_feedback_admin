<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;



    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
