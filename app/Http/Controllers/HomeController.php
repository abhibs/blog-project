<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $datas = Blog::latest()->simplePaginate(3);
        return view("welcome", compact("datas"));
    }

    public function blogDetails($id, $slug)
    {
        $blog = Blog::findOrFail($id);
        $tags = $blog->tags;
        $tags_all = explode(',', $tags);
        $newblogposts = Blog::orderBy('id', 'DESC')->limit(3)->get();

        return view("user.blog-detail", compact("blog", "tags_all", "newblogposts"));


    }
}
