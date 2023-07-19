<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Config, Validator;

class CategoryController extends Controller
{
    // unitPage = Result per Page
    
    var $unitPage = 10;

    public function __construct()
    {
        // get config from app.php
        $this->unitPage = Config::get('app.result_per_page'); // Have to Route::get this
    }
    
    public function index() 
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function onSearch(Request $request)
    {
        $input = $request->searchInput;

        if($input)
        {
            $categories = Category::where('id', 'like', '%'.$input.'%')
            ->orWhere('name', 'like', '%'.$input.'%')
            ->paginate($this->unitPage);
        } else {
            $categories = Category::paginate($this->unitPage);
        }
        return view('category/index', compact('categories'));
    }

    public function getFormEdit(Request $body)
    {
        $category = Category::find($body->id);
        return view('category/edit')
            ->with('category', $category);
    }

    public function onUpdate(Request $body) {

        
        $validate_data = array(
            'name' => $body->name
        );
        
        $validate_rules = array(
            'name' => 'required'
        );
        
        $validate_message = array(
            'required' => 'โปรดกรอกช้อมูล :attribute'
        );
        
        $validator_result = Validator::make($validate_data, $validate_rules, $validate_message);
        if ($validator_result->fails()) {
            return redirect('category/edit/'.$body->id)
            ->withErrors($validator_result)
            ->withInput();
        }
        
        $category = Category::find($body->id);
        $category->name = $body->name;
        $category->save();
        
        return redirect('/category')
            ->with('ok', true)
            ->with('msg', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function getFormAdd()
    {
        return view('category/add');
    }

    public function onInsert(Request $body) {
        
        $validate_data = array(
            'name' => $body->name
        );

        $validate_rules = array(
            'name' => 'required'
        );

        $validate_message = array(
            'required' => 'โปรดกรอกช้อมูล :attribute'
        );

        $validator_result = Validator::make($validate_data, $validate_rules, $validate_message);
        if ($validator_result->fails()) {
            return redirect('category/add')
                ->withErrors($validator_result)
                ->withInput();
        }

        $category = new Category();
        $category->name = $body->name;
        $category->save();

        return redirect('/category')
            ->with('ok', true)
            ->with('msg', 'บันทึกข้อมูลสำเร็จ');
    }

    public function onRemove($id)
    {
        Category::find($id)->delete();
        return redirect('category')
            ->with('ok', true)
            ->with('msg', 'Remove Data Completed.');
    }
}
