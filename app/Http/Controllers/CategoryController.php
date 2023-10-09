<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function get_category(Request $request)
    {
        $category=Category::all();
        return response()->json(array('category' => $category));
    }
}
