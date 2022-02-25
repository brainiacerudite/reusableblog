<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Comment::class);

        $data['pageTitle'] = 'Browse Comments';
        $data['datas'] = Comment::orderBy('id', 'desc')->get();
        return view('admin.comments.index', $data);
    }

    public function approve(Request $request, $commentID)
    {
        $this->authorize('update', Comment::class);

        $comment = Comment::find($commentID);
        $comment->approved = 1;
        $comment->save();
        return redirect(route('admin.comments.index'))->with('success', 'Approved successfully');
    }

    public function unapprove(Request $request, $commentID)
    {
        $this->authorize('update', Comment::class);

        $comment = Comment::find($commentID);
        $comment->approved = 0;
        $comment->save();
        return redirect(route('admin.comments.index'))->with('success', 'Unapproved successfully');
    }

    public function reply(Request $request, $commentID)
    {
        $this->authorize('update', Comment::class);

        $request->validate([
            'comment'     =>  'required',
            'comment_parent'     =>  'required',
            'comment_post_ID'     =>  'required',
        ]);

        $comment = new Comment;
        $comment->name = Auth::user()->name . ' (Admin)';
        $comment->email = Auth::user()->email;
        $comment->comment = $request->comment;
        if ($request->comment_parent != 0) {
            $comment->parent_id = $request->comment_parent;
        }

        $post = Post::find($request->comment_post_ID);
        $post->comments()->save($comment);

        return redirect(route('admin.comments.index'))->with('success', 'Reply sent!');
    }

    public function edit($commentID)
    {
        $this->authorize('update', Comment::class);

        $data['pageTitle'] = 'Edit Comment';
        $data['formType'] = 'edit';
        $data['comment'] = Comment::find($commentID);
        return view('admin.comments.edit', $data);
    }

    public function update(Request $request, $commentID)
    {
        $this->authorize('update', Comment::class);

        $request->validate([
            'comment'     =>  'required',
        ]);

        $comment = Comment::find($commentID);
        $comment->comment = $request->comment;
        $comment->save();
        return redirect(route('admin.comments.index'))->with('success', 'Updated successfully');
    }

    public function destroy($commentID)
    {
        $this->authorize('delete', Comment::class);

        $comment = Comment::find($commentID);
        $comment->delete();

        return redirect(route('admin.comments.index'))->with('success', 'Deleted successfully');
    }
}
