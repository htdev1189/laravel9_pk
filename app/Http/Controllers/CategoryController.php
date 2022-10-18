<?php

namespace App\Http\Controllers;

//model
use App\Models\Category;
//slug helper
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categories;

    function __construct() {
        $this->categories = Category::all();
    }


    function add()
    {
        return view('backend/category/add',[
            'categories'=>$this->categories
        ]);
    }

    function getAllCat()
    {
        return view('backend/category/list',[
            'categories'=>$this->categories
        ]);
    }

    public function store(Request $request){
        $category = new Category();
        $data = $request->input();
        $category->name = $data['name'];
        $category->slug = Str::of($data['name'])->slug('-');
        $category->parent = $data['parent'];
        $category->description = $data['description'];
        $category->image = $data['image'];
        $category->save();
        return redirect('/admin/category/list');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect('/admin/category/list');
        }
    }
}
