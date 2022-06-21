<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $product) {
        $this-> product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'type' => 'Shoe',
            'name' => 'Nike',
            'price' => 1000,
            'amount' => 2,
            'images' => [
                ['http://sample.com/test1'],
                ['http://sample.com/test2'],
                ['http://sample.com/test3'],
                ['http://sample.com/test4'],
            ]
        ];
        return response()->json($this->product->create(collect($data)));
        // return response()->json($this->product->getAllProducts());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'type' => 'Shoe',
            'name' => 'Nike',
            'price' => 1000,
            'amount' => 2,
            'images' => [
                ['http://sample.com/test1'],
                ['http://sample.com/test2'],
                ['http://sample.com/test3'],
                ['http://sample.com/test4'],
            ]
        ];
        return response()->json($this->product->create(collect($data)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
