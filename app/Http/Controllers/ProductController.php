<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use Config, Validator;

class ProductController extends Controller
{
    // unitPage = Result per Page
    
    var $unitPage = 5;

    public function __construct()
    {
        // get config from app.php
        $this->unitPage = Config::get('app.result_per_page'); // Have to Route::get this
    }

    public function index() 
    {
        $products = Product::paginate($this->unitPage);
        return view('product/index', compact('products'));
    }

    public function getFormEdit($id)
    {
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ');
        $product = Product::where('id', $id)->first();
        return view('product/edit')
            ->with('product', $product)
            ->with('categories', $categories);
    }

    public function getFormAdd()
    {
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ');
        return view('product/add')
            ->with('categories', $categories);
    }

    public function onSearch(Request $request)
    {
        $input = $request->searchInput;

        if($input)
        {
            $products = Product::where('code', 'like', '%'.$input.'%')
            ->orWhere('name', 'like', '%'.$input.'%')
            ->orWhere('price', 'like', '%'.$input.'%')
            ->paginate($this->unitPage);

            foreach ($products as $p) {
                $p->image_url = asset($p->image_url);
            }
        } else {
            // "Searching" is an array for some reason, so i have to put foreach to iterate through it.
            $products = Product::paginate($this->unitPage);
            foreach ($products as $p) {
                $p->image_url = asset($p->image_url);
            }
        }
        return view('product/index', compact('products'));
    }

    // public function onActionProduct($id = null)
    // {
    //     $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ');

    //     if($id)
    //     {
    //         // Edit view
    //         $product = Product::where('id', $id)->first();
    //         return view('product/edit')
    //         ->with('product', $product)
    //         ->with('categories', $categories);
    //     } else {
    //         // Add view
    //         return view('product/add')
    //         ->with('categories', $categories);
    //     }
        
    // }

    public function onInsert(Request $request)
    {
        $rules = array(
            'code' => 'required', 
            'name' => 'required',
            'category_id' => 'required|numeric',
            'stock_qty' => 'numeric', 
            'price' => 'numeric',
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        // $id = $request->id;

        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'stock_qty' => $request->stock_qty,
            'price' => $request->price,
        );

        $validator = Validator::make($temp, $rules, $messages);
        if($validator->fails())
        {
            return redirect('product/add')
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->stock_qty = $request->stock_qty;
        $product->price = $request->price;
        $product->save();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $upload_to = 'upload/images';

            // Get Path
            $relative_path = $upload_to.'/'.$file->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            // Upload file
            $file->move($absolute_path, $file->getClientOriginalName());

            // Save image path to database
            // Image::make(public_path().'/'.$relative_path)->resize(250, 250)->save();
            $product->image_url = $relative_path;
            $product->save();
        }

        return redirect('product')
            ->with('ok', true)
            ->with('msg', 'Save Data Completed.');
    }

    public function onUpdate(Request $request)
    {
        $rules = array(
            'code' => 'required', 
            'name' => 'required',
            'category_id' => 'required|numeric',
            'stock_qty' => 'numeric', 
            'price' => 'numeric',
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $id = $request->id;

        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'stock_qty' => $request->stock_qty,
            'price' => $request->price,
        );

        $validator = Validator::make($temp, $rules, $messages);
        if($validator->fails())
        {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->stock_qty = $request->stock_qty;
        $product->price = $request->price;

        $product->save();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $upload_to = 'upload/images';

            // Get Path
            $relative_path = $upload_to.'/'.$file->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            // Upload file
            $file->move($absolute_path, $file->getClientOriginalName());

            // Save image path to database
            // Image::make(public_path().'/'.$relative_path)->resize(250, 250)->save();
            $product->image_url = $relative_path;
            $product->save();
        }

        return redirect('product')
            ->with('ok', true)
            ->with('msg', 'Save Data Completed.');
    }

    public function onRemove($id)
    {
        Product::find($id)->delete();
        return redirect('product')
            ->with('ok', true)
            ->with('msg', 'Remove Data Completed.');
    }
}
