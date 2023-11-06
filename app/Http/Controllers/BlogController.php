<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Intervention\Image\Facades\Image;
use App\Models\Blog;
use Carbon\Carbon;
use Mail;


class BlogController extends Controller
{
    public function blog()
    {
        $datas = Blog::latest()->get();
        return view("user.blog", compact('datas'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'image' => 'required',
        //     'title' => 'required|min:10',
        //     'content' => 'required|min:10',

        // ]);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('storage/blog/' . $name_gen);
        $save_url = 'storage/blog/' . $name_gen;

        Blog::insert([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),
            'tags' => $request->tags,
            'content' => $request->content,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user-blog')->with($notification);

    }

    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        return response()->json($data);

    }

    public function update(Request $request)
    {

        $id = $request->blog_id;

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('storage/blog/' . $name_gen);
        $save_url = 'storage/blog/' . $name_gen;

        Blog::findOrFail($id)->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),
            'tags' => $request->tags,
            'content' => $request->content,
            'image' => $save_url,
        ]);


        $notification = array(
            'message' => 'Blog Updated Successfully',
            'alert-type' => 'success'

        );

        return redirect()->route('user-blog')->with($notification);


    }

    public function delete($id)
    {
        // dd($id);
        $data = Blog::findOrFail($id);
        $img = $data->image;
        unlink($img);

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'

        );
        return redirect()->back()->with($notification);

    }

    public function userCommentStore(Request $request)
    {

        $blog_id = $request->blog_id;

        Comment::insert([
            'user_id' => Auth::user()->id,
            'blog_id' => $blog_id,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);


        $notification = array(
            'message' => 'Comment Inserted Successfully',
            'alert-type' => 'success'
        );

        Mail::send('mail.comment', [
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'subject' => $request->subject,
        ], function ($message) use ($request) {
            $message->from(Auth::user()->email);
            $message->subject('Blog Comment');
            $message->to('abhirambs97@gmail.com');
        });

        return redirect()->back()->with($notification);

    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $datas = Blog::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('content', 'LIKE', '%' . $search . '%')
            ->get();

        // dd($datas);

        return view('user.search', compact('datas'));
    }
}
