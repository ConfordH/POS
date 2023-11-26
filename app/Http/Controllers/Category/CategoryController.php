<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories  = Category::all();
        if($categories){
            return response()->json([
                'message' => 'Success',
                'results' => ['categories' => $categories],
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
        $validate  = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validate){
            $category = Category::create([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'description' => $request->description
            ]);
            if($category){
                return response()->json([
                    'message' => 'Successfully created a category',
                    'result' => ['category' => $category],
                    'status_code' => 201
                ], 201);
            }
            return response()->json([
                'message' => 'Error. Something went wrong. Please Check and try again',
                'result' => ['category' => $category],
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
        $category = Category::where('slug', $slug)->first();
        if($category){
            return response()->json([
                'message' => 'Successfully found a record',
                'result' => ['category' => $category],
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Success. No record was found',
            'result' => ['category' => $category],
            'status_code' => 200
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $category = Category::where('slug', $slug)->first();
        $validate  = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validate){
            $category->name = $request->name;
            $category->slug = str_slug($request->name);
            $category->description = $request->description;
            $saved  = $category->save();
            if($saved){
                return response()->json([
                    'message' => 'Successfully updated category',
                    'result' => ['category_name' => $request->name],
                    'status_code' => 201
                ], 201);
            }
            return response()->json([
                'message' => 'Something went wrong. Try again',
                'result' => ['category_name' => $request->name],
                'status_code' => 400
            ], 400);
        }
        return response()->json([
            'message' => 'Please provide all required fields',
            'result' => ['category_name' => $request->name],
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
        $category = Category::where('slug', $slug)->first();
        if($category){
            $category->delete();
            return response()->json([
                'message' => 'Successfully deleted category',
                'result' => ['category_name' => $category->name],
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
