<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator;

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
            $products = Product::paginate(5);
            $response = array('status'=> true,'message'=>'','data'=>$products);
            return response()->json($response, 200);
        } catch (\Exception $ex) {
            $response = array('status'=> false,'message'=>$ex->getMessage(),'data'=>[]); 
            return response()->json($response, 401);
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
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
        $validator = Validator::make($request->all(), 
        [
            'name' => ['required'],
            'price' => ['regex:'.$regex]
        ],
        [
            'name.string' => 'Product name must be string.',
            'price.regex' => 'Price must be an numeric.'
        ]);
        if ($validator->fails()) { 
            $response = array('status'=> false,'message'=>$validator->errors(),'data'=>[]);
            return response()->json($response, 400);           
        }
        try {
            $product = Product::create($request->all());
            $response = array('status'=> true,'message'=>'Product registerd successfully.','data'=>$product);
            return response()->json($response, 201); 
        } catch (\Exception $ex) {
            $response = array('status'=> false,'message'=>$ex->getMessage(),'data'=>[]); 
            return response()->json($response, 401);
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
        if(!is_numeric($id) || $id <= 0){
            $response = array('success' => false,'message'=>'Product Id must be numeric.','data' => []); 
            return response()->json($response, 404);    
        }

        $product = Product::find($id);

        if(!$product){
            $response = array('success' => false,'message'=>'Product not exist!','data' => []);
            return response()->json($response, 404);
        }else{
            $response = array('success' => true,'message'=>'','data' => $product);
            return response()->json($response, 404);
        }
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
    public function update(Request $request, $id)
    {
        if(!is_numeric($id) || $id <= 0){
            $response = array('success' => false,'message'=>'Product Id must be numeric.','data' => []); 
            return response()->json($response, 404);    
        }

        $product = Product::find($id);

        if(!$product){
            $response = array('success' => false,'message'=>'Product not exist!','data' => []);
            return response()->json($response, 404);
        }

        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
        $validator = Validator::make($request->all(), 
        [
            'name' => ['required'],
            'price' => ['regex:'.$regex]
        ],
        [
            'name.string' => 'Product name must be string.',
            'price.regex' => 'Price must be an numeric.'
        ]);
        if ($validator->fails()) { 
            $response = array('status'=> false,'message'=>$validator->errors(),'data'=>[]);
            return response()->json($response, 400);           
        }
        try {
            Product::where('id',$id)->update($request->all());
            $response = array('status'=> true,'message'=>'Product updated successfully.','data'=>[]);
            return response()->json($response, 200); 
        } catch (\Exception $ex) {
            $response = array('status'=> false,'message'=>$ex->getMessage(),'data'=>[]); 
            return response()->json($response, 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!is_numeric($id) || $id <= 0){
            $response = array('success' => false,'message'=>'Product Id must be numeric.','data' => []); 
            return response()->json($response, 404);    
        }

        $product = Product::find($id);

        if(!$product){
            $response = array('success' => false,'message'=>'Product not exist!','data' => []);
            return response()->json($response, 404);
        }

        try {
            Product::destroy($id);
            $response = array('status'=> true,'message'=>'Product deleted successfully.','data'=>[]);
            return response()->json($response, 200); 
        } catch (\Exception $ex) {
            $response = array('status'=> false,'message'=>$ex->getMessage(),'data'=>[]); 
            return response()->json($response, 401);
        }

    }
}
