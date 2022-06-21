<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository 
{
    public $product;

    protected $name;
    protected $price;
    protected $amount;
    protected $images;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function __get($id)
    {
        return $this->find($id);
    }

    public function find($id)
    {
        return $this->toArray($this->product->find($id));
    }

    protected function toArray(Product $product)
    {
        return [
            'id' => $product->id,
            'price' => $product->productMeta->where('key' , 'price')->value,
            'amount' => $product->productMeta->where('key' , 'amount')->value,
            'images' => $product->getProductContents(),
        ];
    }

    public function create($request)
    {
        $product = $this->product->create(['type' => $request->type]);
        $product->productMeta()->createMany([
            ['key' => 'price','value' => $request->price],
            ['key' => 'amount','value' => $request->amount],
        ]);
        $urls = $request->urls;
        $product->contents()->attach($urls);
    }
}