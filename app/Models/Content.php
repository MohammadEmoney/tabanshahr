<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'url', 'data'
    ];

    /**
     * Product Relations
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getProductContents()
    {
        $data = [];
        foreach($products as $product)
            $data[] = $product->url;
        return $data;
    }
}
