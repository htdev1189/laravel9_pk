<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//model
use App\Models\Category;
use App\Models\Post;

//slug helper
use Illuminate\Support\Str;

// rule
use Illuminate\Validation\Rule;


class PostController extends Controller
{

    protected $categories;
    protected $posts;

    function __construct()
    {
        parent::__construct();
        $this->categories = Category::all();
        $this->posts = Post::all();
    }

    public function getAllCat()
    {
        return view('backend/posts/list', [
            'posts' => $this->posts
        ]);
    }

    public function add()
    {
        return view('backend/posts/add', [
            'categories' => $this->categories
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:App\Models\Post,title',
            'content' => 'required'
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'content.required' => 'Content không được để trống'
        ]);
        $post = new Post();
        $data = $request->input();
        $post->title = $data['title'];
        $post->slug = Str::of($data['title'])->slug('-');
        $post->category = $data['category'];
        $post->description = $data['description'];
        $post->image = $data['image'];
        $post->content = $data['content'];
        $post->save();
        return redirect('/admin/posts/list');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect('/admin/posts/list');
        }
    }

    public function edit($id)
    {
        return view('backend/posts/edit', [
            'post' => Post::find($id),
            'categories' => $this->categories
        ]);
    }

    public function update(Request $request)
    {

        $data = $request->input();

        $request->validate([
            'title' => [
                'required',
                Rule::unique('posts', 'title')->ignore($data['id']),
            ],
            'content' => 'required'
        ], [
            'title.required' => 'Title không được để trống',
            'title.unique' => 'Bài viết đã tồn tại',
            'content.required' => 'Nội dung không được để trống',
        ]);



        $post = Post::find($data['id']);

        $post->title = $data['title'];
        $post->slug = Str::of($data['title'])->slug('-');
        $post->category = $data['category'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->image = $data['image'];

        $post->save();
        return redirect('/admin/posts/list');
    }
}
