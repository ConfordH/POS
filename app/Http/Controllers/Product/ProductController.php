<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products  = Product::all();
        if($products){
            return response()->json([
                'message' => 'Success',
                'results' => ['products' => $products],
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Success. No records found',
            'result' => [],
            'status_code' => 200
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *~
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
        $validate  = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        if($validate){
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'slug' => str_slug($request->name),
                'price' => $request->price,
                'description' => $request->description
            ]);
            if($product){
                return response()->json([
                    'message' => 'Successfully created a product',
                    'result' => ['product' => $product],
                    'status_code' => 201
                ], 201);
            }
            return response()->json([
                'message' => 'Error. Something went wrong. Please Check and try again',
                'result' => ['product' => $product],
                'status_code' => 400
            ], 400);
        }
        return response()->json([
            'message' => 'Error. Please provide all the required fields',
            'result' => [],
            'status_code' => 400
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if($product){
            return response()->json([
                'message' => 'Successfully found a record',
                'result' => ['product' => $product],
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Success. No record was found',
            'result' => ['product' => $product],
            'status_code' => 200
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        $validate  = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
        if($validate){
            $product->name = $request->name;
            $product->slug = str_slug($request->name);
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->description = $request->description;
            $saved  = $product->save();
            if($saved){
                return response()->json([
                    'message' => 'Successfully updated product',
                    'result' => ['product_name' => $request->name],
                    'status_code' => 201
                ], 201);
            }
            return response()->json([
                'message' => 'Something went wrong. Try again',
                'result' => ['product_name' => $request->name],
                'status_code' => 400
            ], 400);
        }
        return response()->json([
            'message' => 'Please provide all required fields',
            'result' => ['product_name' => $request->name],
            'status_code' => 400
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if($product){
            $product->delete();
            return response()->json([
                'message' => 'Successfully deleted product',
                'result' => ['product_name' => $product->name],
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Success. No record was found',
            'result' => [],
            'status_code' => 200
        ], 200);
    }
}
