<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Banner::class, 'banners');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Browse Ads Banner';
        $data['datas'] = Banner::orderBy('created_at', 'desc')->get();
        return view('admin.banner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Ad Banner';
        $data['formType'] = 'add';
        return view('admin.banner.edit', $data);
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
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
        ]);

        $banner = new Banner;
        $banner->name = $request->name;
        if ($request->hasFile('image')) {
            // Upload Image Logic
            $bannerImage = uploadOne($request->file('image'), 'banner', preg_replace('/[^a-z0-9]+/', '_', strtolower($request->name)), '300x250');
            $banner->image = $bannerImage;
        }
        if (!empty($request->adurl)) {
            $banner->adurl = $request->adurl;
        }
        $banner->status = 0;
        if (!empty($request->status) && ($request->status == 'on' || $request->status == 1)) {
            $banner->status = 1;
        }
        $banner->save();

        return redirect(route('admin.banner.index'))->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return redirect(route('admin.banner.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $data['pageTitle'] = 'Edit Ad Banner';
        $data['formType'] = 'edit';
        $data['data'] = $banner;
        return view('admin.banner.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
        ]);

        $banner->name = $request->name;
        if ($request->hasFile('image')) {
            // Delete existing file
            if ($banner->image != null) {
                deleteFile(public_path($banner->image));
            }
            // Upload Image Logic
            $bannerImage = uploadOne($request->file('image'), 'banner', preg_replace('/[^a-z0-9]+/', '_', strtolower($request->name)), '300x250');
            $banner->image = $bannerImage;
        }
        if (!empty($request->adurl)) {
            $banner->adurl = $request->adurl;
        }
        $banner->status = 0;
        if (!empty($request->status) && ($request->status == 'on' || $request->status == 1)) {
            $banner->status = 1;
        }
        $banner->save();

        return redirect(route('admin.banner.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        // Delete existing file
        if ($banner->image != null) {
            deleteFile(public_path($banner->image));
        }
        $banner->delete();
        return redirect(route('admin.banner.index'))->with('success', 'Deleted Successfully');
    }
}
