<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSize\StoreProductSizeRequest;
use App\Http\Requests\ProductSize\UpdateProductSizeRequest;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsizes = DB::table('product_sizes')->paginate(5);
        
        return response()->json([
            'success' => true,
            'payload' => $productsizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductSizeRequest $request)
    {
        $request = $request->validated();

        $productsize = ProductSize::create( $request );

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSize $productsize)
    {
        return response()->json([
            'success' => true,
            'payload' => $productsize
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductSizeRequest $request, ProductSize $productsize)
    {
        $request = $request->validated();

        $productsize = $productsize->update( $request );

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSize $productsize)
    {
        $productsize = $productsize->delete( $productsize );

        if ($productsize) return response()->json([
            'success' => true,
        ]);
    }
}