<?php

namespace App\Http\Controllers;

//model
use App\Models\Category;
//slug helper
use Illuminate\Support\Str;

// request
use Illuminate\Http\Request;

// add category request
use App\Http\Requests\addCatRequest;
// edit category request
use App\Http\Requests\editCatRequest;
// rules
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    protected $categories;

    function __construct()
    {
        // $this->categories = Category::all();
        $this->categories = Category::orderByDesc('id')->get();
    }


    function add()
    {
        return view('backend/category/add', [
            'categories' => $this->categories
        ]);
    }

    function getAllCat()
    {
        return view('backend/category/list', [
            'categories' => $this->categories
        ]);
    }

    public function store(addCatRequest $request)
    {

        $validated = $request->validated();

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

    public function edit($id)
    {
        return view('backend/category/edit', [
            'category' => Category::find($id),
            'categories' => $this->categories
        ]);
    }

    public function update(Request $request)
    {

        $data = $request->input();

        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($data['id']),
            ]
        ], [
            'name.required' => 'Danh mục không được để trống',
            'name.unique' => 'Danh mục đã tồn tại'
        ]);

        $category = Category::find($data['id']);

        $category->name = $data['name'];
        $category->slug = Str::of($data['name'])->slug('-');
        $category->parent = $data['parent'];
        $category->description = $data['description'];
        $category->image = $data['image'];

        $category->save();
        return redirect('/admin/category/list');
    }
}
