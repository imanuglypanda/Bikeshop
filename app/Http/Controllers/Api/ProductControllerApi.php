<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductControllerApi extends Controller
{
    public function product_list($category_id = null) {
        if($category_id) {
            $products = Product::where('category_id', $category_id)->get();
        } else {
            $products = Product::all();
        }
        // $products = Product::all();
        return response()->json(array ( 
            'ok' => true,
            'products' => $products,
        ));
    }

    public function product_search(Request $request) {
        // $query = $request->query; // is an object of type ParameterBag which contains the Query Params for GET Requests.
        $query = $request->get('query'); // should rather use $request->get('query') in these circumstances
        
        if($query) {
            $products = Product::where('name', 'like', '%'.$query.'%')->get();
        } else {
            $products = Product::all();
        }
        
        return response()->json(array(
            'ok' => true,
            'products' => $products,
        ));
    }
}
