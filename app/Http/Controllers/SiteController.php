<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = 'Get fully entertained at ' . config('settings.sitename');
        $data['posts'] = Post::published()->orderBy('created_at', 'desc')->paginate(8);
        return view('site.index', $data);
    }

    public function search(Request $request)
    {
        $data['pageTitle'] = 'Search for anything.';
        $string = $request->s;
        $data['posts'] = Post::published()->where('title', 'LIKE', '%' . $string . '%')->orWhere('meta_description', 'LIKE', '%' . $string . '%')->orderBy('created_at', 'desc')->paginate(8);
        $data['pT'] = 'Search Results for';
        $data['pC'] = $string;
        return view('site.category', $data);
    }

    public function page($page)
    {
        $data['data'] = Page::where('slug', $page)->first();
        $data['pageTitle'] = $data['data']->title;
        return view('site.page', $data);
    }

    public function contact()
    {
        $data['pageTitle'] = 'Contact Us';
        return view('site.contact', $data);
    }

    public function postContact(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name'      =>  'max:30',
            'email'     =>  'required|email|max:30',
            'message'   =>  'required|max:200'
        ]);

        // $message = new Message();
        // $message->name = $request->name;
        // $message->email = $request->email;
        // $message->message = $request->message;
        // $message->save();
        // return redirect()->route('contact')->with('success', 'Message has been posted. We will contact you soon..');
        return redirect()->route('contact')->with('success', 'Unavailable at the moment');
    }

    public function singlePost($slug)
    {
        $data['pageTitle'] = 'Single post title';
        $data['post'] = Post::where('slug', $slug)->first();

        $viewCounter = Session::get('viewed_pages', []);
        if (!in_array($data['post']->slug, $viewCounter)) {
            $data['post']->incrementReadCount();
            Session::push('viewed_pages', $data['post']->slug);
        }

        return view('site.single-blog', $data);
    }

    public function tag($slug)
    {
        $data['pageTitle'] = 'View posts tagged';
        $tag = Tag::where('slug', $slug)->first();
        $data['posts'] = $tag->posts()->published()->orderBy('created_at', 'desc')->paginate(8);
        $data['pT'] = 'All posts tagged in';
        $data['pC'] = $slug;
        return view('site.category', $data);
    }

    public function category($slug)
    {
        $data['pageTitle'] = 'View posts in Category';
        $category = Category::where('slug', $slug)->first();
        if (empty($category)) {
            return abort(404);
        }
        $data['posts'] = $category->posts()->published()->orderBy('created_at', 'desc')->paginate(1);
        $data['pT'] = 'All posts in';
        $data['pC'] = $slug;
        return view('site.category', $data);
    }

    public function author($slug)
    {
        $data['pageTitle'] = 'View posts by Author';
        $data['pT'] = 'All posts by';
        $data['pC'] = $slug;
        return view('site.category', $data);
    }

    public function postComment(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
            'email'   =>  'required|email',
            'comment'     =>  'required',
            'comment_post_ID'     =>  'required',
            'comment_parent'     =>  'required',
        ]);
        // return $request->all();
        if ($request->remember == 1) {
            $request->session()->put('commenter', ['name' => $request->name, 'email' => $request->email]);
        }

        $comment = new Comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        if ($request->comment_parent != 0) {
            $comment->parent_id = $request->comment_parent;
        }

        $post = Post::find($request->comment_post_ID);
        $post->comments()->save($comment);

        return back();
    }
}
