<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    /**
     * Content Relations
     */
    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

    /**
     * ProductMeta Relations
     */
    public function productMeta()
    {
        return $this->hasMany(ProductMeta::class);
    }
}
