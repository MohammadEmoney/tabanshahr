<?php

namespace App\Repositories;

use App\Http\Resources\ProductResource;
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

    public function getAllProducts()
    {
        return ProductResource::collection($this->product->all());
    }

    public function find($id)
    {
        return new ProductResource($this->product->find($id));
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
        return new ProductResource($product);
    }

    public function createContents($urls)
    {
        $contents = [];
        foreach($urls as $url)
            $contents[] = $this->content->create(['url' => $url])->id;
        return $contents;
    }
}
