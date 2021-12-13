<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Product;

class ProductApiController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->only(['getById']);
        //$this->middleware(['client.credentials'])->only(['index']);
    }

    public function store(Request $request){ //explicado en hora 1.25 de clase5
        //Log::info(print_r($request->input(), true));
        $product = Product::create([
            //nombre en bd           //nombre en JSON
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'inventory' => $request->input('inventory'),
            'image' =>  $request->input('image'),
            'category_id' => $request->input('category'),
            'brand_id' => $request->input('brand'),
            'seller_id' => $request->input('seller'),
            'image' => $request->input('image')
        ]);

        return response()->json($product, 201);
    }

    public function index() {
        $products = Product::with(['Category', 'Brand', 'Seller'])->get();
        return response()->json($products, 200);
    }

    public function getById($id) {
        $product = Product::with(['Category', 'Brand', 'Seller'])
                            ->where('id', $id)    
                            ->first();

        if (empty($product)) {
            return response()->json(['message' => 'Not Found'], 404);
        }      

        return response()->json($product, 200);
    }


    
}
