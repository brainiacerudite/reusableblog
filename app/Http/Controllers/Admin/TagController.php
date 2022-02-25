<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tag::class, 'tags');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Browse Tags';
        $data['datas'] = Tag::orderBy('created_at', 'desc')->get();
        $data['rType'] = 'tag';
        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Tag';
        $data['formType'] = 'add';
        $data['rType'] = 'tag';
        return view('admin.categories.edit', $data);
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
            'name' => 'required',
            'slug' => 'required|unique:tags',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->save();
        return redirect(route('admin.tags.index'))->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return redirect(route('admin.tags.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $data['pageTitle'] = 'Edit Tag';
        $data['formType'] = 'edit';
        $data['rType'] = 'tag';
        $data['data'] = $tag;
        return view('admin.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $tag = $tag;
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->save();
        return redirect(route('admin.tags.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag = $tag;
        $tag->delete();

        return redirect(route('admin.tags.index'))->with('success', 'Deleted Successfully');
    }
}
