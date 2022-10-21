<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class frontendController extends Controller
{
    public function home()
    {
        return view('frontend.pages.home',[
            'news_posts' => Post::limit(3)->get(),
            'categories' => Category::where('parent',0)->orderByDesc('id')->get()
        ]);
    }
    public function category($slug)
    {
        $category = Category::where('slug',$slug)->first();
        if (!$category) {
            abort(404);
        }
        return view('frontend.pages.cat',[
            'recent_posts' => Post::limit(3)->get(),
            'categories' => Category::where('parent',0)->orderByDesc('id')->get(),
            'category' => $category,
            'posts' => Category::find($category->id)->getPosts()->paginate(1)
        ]);
    }
    public function post($slug)
    {
        $post = Post::where('slug',$slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.pages.post',[
            'recent_posts' => Post::Where('id','<>',$post->id)->limit(3)->get(),
            'categories' => Category::where('parent',0)->orderByDesc('id')->get(),
            'parent' => Post::find($post->id)->getCategory,
            'post' =>$post
        ]);
    }
}
