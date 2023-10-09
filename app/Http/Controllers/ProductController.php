<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function get_products(Request $request)
    {
        $products=Product::all();
        return  ProductResource::collection($products);
        
    }
}
