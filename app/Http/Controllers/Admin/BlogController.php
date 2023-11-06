<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use Auth;

class BlogController extends Controller
{
    public function index()
    {

        $datas = Comment::where('parent_id', null)->latest()->get();
        return view('admin.comment.index', compact('datas'));

    }

    public function commentReplay($id)
    {

        $comment = Comment::where('id', $id)->first();
        return view('admin.comment.reply', compact('comment'));

    }

    public function replyMessagePost(Request $request)
    {

        $id = $request->id;
        $user_id = $request->user_id;
        $blog_id = $request->blog_id;

        Comment::insert([
            'user_id' => $user_id,
            'blog_id' => $blog_id,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        Mail::send('mail.replay', [
            'subject' => $request->subject,
        ], function ($message) use ($request) {
            $message->from('abhirambs97@gmail.com');
            $message->subject('Blog Comment');
            $message->to(Auth::user()->email);
        });

        $notification = array(
            'message' => 'Reply Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
