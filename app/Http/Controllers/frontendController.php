<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class frontendController extends Controller
{
    public function home()
    {
        return view('frontend.pages.home');
    }
    public function category($slug)
    {
        $category = Category::where('slug',$slug)->first();
        if (!$category) {
            abort(404);
        }
        return view('frontend.pages.cat',[
            'categories' => Category::where('parent',0)->orderByDesc('id')->get(),
            'category' => $category
        ]);
    }
    public function post($slug)
    {
        $post = Post::where('slug',$slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.pages.post',[
            'categories' => Category::where('parent',0)->orderByDesc('id')->get(),
            'post' =>$post
        ]);
    }
}
