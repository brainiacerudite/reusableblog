<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Page::class, 'pages');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Browse Pages';
        $data['datas'] = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Page';
        $data['formType'] = 'add';
        return view('admin.pages.edit', $data);
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
            'slug' => 'required|unique:pages,slug',
            'body' => 'required',
        ]);

        $page = new Page;
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->body = $request->body;
        $page->style = '';
        $page->save();

        return redirect(route('admin.pages.index'))->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return redirect(route('admin.pages.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $data['pageTitle'] = 'Edit Page';
        $data['formType'] = 'edit';
        $data['data'] = $page;
        return view('admin.pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);

        $page = $page;
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->body = $request->body;
        $page->style = '';
        $page->save();

        return redirect(route('admin.pages.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page = $page;
        $page->delete();

        return redirect(route('admin.pages.index'))->with('success', 'Deleted Successfully');
    }
}
