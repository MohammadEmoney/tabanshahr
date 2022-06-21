<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\Content;

class ProductRepository 
{
    public $product;
    public $content;
    public $meta;

    protected $name;
    protected $price;
    protected $amount;
    protected $images;

    public function __construct(Product $product, ProductMeta $meta, Content $content)
    {
        $this->product = $product;
        $this->content = $content;
        $this->meta = $meta;
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
        $product = $this->product->create(['type' => $request['type']]);
        $product->productMeta()->createMany([
            ['key' => 'price','value' => $request['price']],
            ['key' => 'amount','value' => $request['amount']],
        ]);
        $contentIds = $this->createContents($request['images']);
        $product->contents()->attach($contentIds, ['type' => $request['type']]);
        return $this->toArray($product);
    }

    public function createContents($urls)
    {
        $contents = [];
        foreach($urls as $url)
            $contents[] = $this->meta->create(['url' => $url])->id;
        return $contents;
    }
}