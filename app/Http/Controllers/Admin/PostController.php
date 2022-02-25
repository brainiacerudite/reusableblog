<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Browse Posts';
        if (Auth::user()->can('browseall posts')) {
            $data['datas'] = Post::orderBy('created_at', 'desc')->get();
        } else {
            $data['datas'] = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Post';
        $data['formType'] = 'add';
        $data['categories'] = Category::orderBy('slug', 'desc')->get();
        $data['tags'] = Tag::orderBy('slug', 'desc')->get();
        return view('admin.posts.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'category' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'body' => 'required',
        ]);

        // return $request->all();

        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->meta_keywords = $request->meta_keywords ?? '';
        $post->meta_description = $request->meta_description ?? '';
        if ($request->hasFile('image')) {
            // Upload Image
            $post->image = $this->uploadFile($request->file('image'));
        }
        if ($request->hasFile('downloadable')) {
            # Do the file upload here
        }
        $post->body = $request->body;

        $post->save();
        $post->categories()->sync($request->category);
        $fresh = [];
        if (!empty($request->tags)) {
            foreach ($request->tags as $tag) {
                if (Tag::find($tag)) {
                    $fresh[] = $tag;
                } else {
                    $newtag = new Tag;
                    $newtag->name = ucwords(substr($tag, 4));
                    $newtag->slug = strtolower(substr($tag, 4));
                    $newtag->save();

                    $fresh[] = $newtag->id;
                }
            }
        }
        $post->tags()->sync($fresh);

        return redirect(route('admin.posts.index'))->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return redirect(route('admin.posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data['pageTitle'] = 'Edit Post';
        $data['formType'] = 'edit';
        $data['categories'] = Category::orderBy('slug', 'desc')->get();
        $data['tags'] = Tag::orderBy('slug', 'desc')->get();
        $data['data'] = $post;
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'category' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'body' => 'required',
        ]);

        // return $request->all();

        $post = $post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->status = $request->status;
        $post->meta_keywords = $request->meta_keywords ?? '';
        $post->meta_description = $request->meta_description ?? '';
        if ($request->hasFile('image')) {
            // Delete the former image
            deleteFile(public_path($post->image->image));
            deleteFile(public_path($post->image->image_thumb_small));
            deleteFile(public_path($post->image->image_thumb_medium));
            deleteFile(public_path($post->image->image_thumb_display));
            // Upload Image
            $post->image = $this->uploadFile($request->file('image'));
        }
        if ($request->hasFile('downloadable')) {
            # Do the file upload here
        }
        $post->body = $request->body;

        $post->save();
        $post->categories()->sync($request->category);
        $fresh = [];
        if (!empty($request->tags)) {
            foreach ($request->tags as $tag) {
                if (Tag::find($tag)) {
                    $fresh[] = $tag;
                } else {
                    $newtag = new Tag;
                    $newtag->name = ucwords(substr($tag, 4));
                    $newtag->slug = strtolower(substr($tag, 4));
                    $newtag->save();

                    $fresh[] = $newtag->id;
                }
            }
        }
        $post->tags()->sync($fresh);

        return redirect(route('admin.posts.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = $post;
        //-Todo Logic to delete all post images
        deleteFile(public_path($post->image->image));
        deleteFile(public_path($post->image->image_thumb_small));
        deleteFile(public_path($post->image->image_thumb_medium));
        deleteFile(public_path($post->image->image_thumb_display));
        // Delete Post
        $post->delete();

        return redirect(route('admin.posts.index'))->with('success', 'Deleted Successfully');
    }

    public function uploadFile($requestImage)
    {
        if ($requestImage->isValid()) {
            $fileName = $requestImage->getClientOriginalName();
            $fileName = str_replace(' ', '-', $fileName);

            $fileName = rand(11111111, 99999999) . "_" . time() . "_" . $fileName;
            $fileName_thumb_small = rand(11111111, 99999999) . "_" . time() . "_thumb_small_" . $fileName;
            $fileName_thumb_medium = rand(11111111, 99999999) . "_" . time() . "_thumb_medium_" . $fileName;
            $fileName_thumb_display = rand(11111111, 99999999) . "_" . time() . "_thumb_display_" . $fileName;

            //upload
            $folder = 'uploads/posts/' . date('Y') . '/' . date('m');
            $path = public_path($folder);

            // dd($path);

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }


            // Actual image
            $imageUrl = $path . '/' . $fileName;
            Image::make($requestImage)->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($imageUrl);

            $uploaded_url = $folder . '/' . $fileName;
            // Actual


            //display image 950 x 573 pixels
            $imageUrl_thumb_display = $path . '/' . $fileName_thumb_display;
            Image::make($requestImage)->fit(950, 573)->save($imageUrl_thumb_display)->encode('jpg', 85);

            $uploaded_url_thumb_display = $folder . '/' . $fileName_thumb_display;
            //small image

            //small image 370 x 230 pixels
            $imageUrl_thumb_small = $path . '/' . $fileName_thumb_small;
            Image::make($requestImage)->fit(370, 230)->save($imageUrl_thumb_small)->encode('jpg', 70);

            $uploaded_url_thumb_small = $folder . '/' . $fileName_thumb_small;
            //small image


            //medium image 70 x 70 pixels
            $imageUrl_thumb_medium = $path . '/' . $fileName_thumb_medium;
            Image::make($requestImage)->fit(70, 70)->save($imageUrl_thumb_medium)->encode('jpg', 70);

            $uploaded_url_thumb_medium = $folder . '/' . $fileName_thumb_medium;
            //medium image


            $pImage = [
                'image' => $uploaded_url,
                'image_thumb_small' => $uploaded_url_thumb_small,
                'image_thumb_medium' => $uploaded_url_thumb_medium,
                'image_thumb_display' => $uploaded_url_thumb_display
            ];
            return $pImage;
        }
    }
}
