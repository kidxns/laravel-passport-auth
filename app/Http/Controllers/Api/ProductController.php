<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\Product as ProductRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = auth()->user()->products;
        return response(['data' => $products]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product -> user_id = auth()->user()->id;
        $product -> name = $request -> name;
        $product -> price = $request -> price;
        $product -> amount  = $request -> amount;
        $product -> published = false;
        $product -> description = $request -> description;

        if($product->save()){
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        }

        else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = auth()->user()->products->find($id);
        if(!$product){
            return response()->json([
                'success' => false,
                'message' => 'Product not found!'
            ], 400);

        }
        else{
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * input: @id = the product 's id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = auth()->user()->products->find($id);
        if(!$product){
            return response()->json([
                'success' => false,
                'message' => 'Have not products'
            ], 400);
        }

        $update = $product->fill($request->all())->save();

        if($update){
            return response()->json([
                'success' => true,
                'message' => 'The product has updated!'

            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'

            ]);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * input : the product 's id
     * return : destroy the product
     */
    public function destroy($id)
    {
        $product = auth()->user()->products->find($id);

        if($product -> delete()){
            return response()->json([
                'success' => true,
                'message' => 'Deleted! '
            ]);

        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 400);
        }

    }
}
