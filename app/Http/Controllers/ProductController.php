<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $product = Product::all();
            
            if(count($product) == 0) {
                return response()->json([
                    'respCode' => '000001', 
                    'message' => 'No product available'
                ]);
            }

            return response()->json([
                'respCode' => '000000',
                'message' => 'success',
                'products' => $product
            ]);

        }catch (Exception $e) {
            return response()->json([
                'error' => $e,
            ]);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->input(),[
                'price' => 'numeric',
                'stock' => 'integer'
            ]);

            if($validator->fails()) {
                return $validator->errors();
            }

            $product = Product::create([
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock')
            ]);

            if($product->exists) {
                return response()->json([
                    'respCode' => '000000',
                    'message' => 'Product successfully saved',
                ]);
            }else {
                return response()->json([
                    'respCode' => '000001',
                    'message' => 'Something went wrong'
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'error' => $e,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);
            
            if(empty($product) || $product == null) {
                return response()->json([
                    'respCode' => '000001',
                    'message' => 'Product does not exist',
                ]);
            }

            return response()->json([
                'respCode' => '000000',
                'message' => 'success',
                'products' => $product
            ]);
            
        }catch (Exception $e) {
            return response()->json([
                'error' => $e,
            ]);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->input(),[
                'price' => 'numeric',
                'stock' => 'integer'
            ]);

            if($validator->fails()) {
                return $validator->errors();
            }

            $product = Product::find($id);

            if(empty($product) || $product == null) {
                return response()->json([
                    'respCode' => '000001',
                    'message' => 'Product does not exist',
                ]);
            }

            $prod_name = empty($request->input('name')) ? $prod_name = $product->name : $prod_name = $request->input('name');
            $prod_desc = empty($request->input('desc')) ? $prod_desc = $product->desc : $prod_desc = $request->input('desc');
            $prod_price = empty($request->input('price')) ? $prod_price = $product->price : $prod_price = $request->input('price');
            $prod_stock = empty($request->input('stock')) ? $prod_stock = $product->stock : $prod_stock = $request->input('stock');
            
            $product->name = $prod_name;
            $product->desc = $prod_desc;
            $product->price = $prod_price;
            $product->stock = $prod_stock;

            if($product->save()) {
                return response()->json([
                    'respCode' => '000000',
                    'message' => 'Product successfully updated',
                    'product' => $product
                ]);
            }
        }catch (Exception $e) {
            return response()->json([
                'error' => $e,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(empty($product) || $product == null) {
            return response()->json([
                'respCode' => '000001',
                'message' => 'Product does not exist',
            ]);
        }

        if($product->delete()){
            return response()->json([
                'respCode' => '000000',
                'message' => 'Product deleted successfully',
                'product' => $product
            ]);
        }else{
            return response()->json([
                'respCode' => '000001',
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function destroyAll()
    {
        if(Product::query()->delete()) {
            return response()->json([
                'respCode' => '000000',
                'message' => 'All products deleted successfully'
            ]);
        }else{
            return response()->json([
                'respCode' => '000001',
                'message' => 'Something went wrong',
            ]);
        }
    }
}
