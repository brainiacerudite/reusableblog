<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Menu::class, 'menus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Menu Builder';
        $data['datas'] = Menu::where('parent_id', 0)->orderBy('order')->get();
        return view('admin.menus.index', $data);
    }

    public function order(Request $request)
    {
        $menuItemOrder = json_decode($request->order);

        $this->orderMenu($menuItemOrder);
    }

    private function orderMenu(array $menuItems, $parentId = 0)
    {
        foreach ($menuItems as $index => $menuItem) {
            $item = Menu::findOrFail($menuItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Create Menu';
        $data['formType'] = 'add';
        return view('admin.menus.edit', $data);
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
            'type' => 'required',
            'target' => 'required',
        ]);

        $menu = new Menu;
        $menu->title = $request->title;
        if ($request->type == 'route') {
            $menu->url = '';
            // get the route & parameters
            $menu->route = $request->route;
            $menu->parameters = $request->parameters;
        } else {
            $menu->route = null;
            $menu->parameters = '';
            // get the url
            $menu->url = $request->url;
        }
        $menu->target = $request->target;
        $menu->order = $menu->highestOrderMenuItem();
        $menu->save();
        return redirect(route('admin.menus.index'))->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return redirect(route('admin.menus.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $data['pageTitle'] = 'Edit Menu';
        $data['formType'] = 'edit';
        $data['data'] = $menu;
        return view('admin.menus.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu = $menu;
        $menu->title = $request->title;
        if ($request->type == 'route') {
            $menu->url = '';
            // get the route & parameters
            $menu->route = $request->route;
            $menu->parameters = $request->parameters;
        } else {
            $menu->route = null;
            $menu->parameters = '';
            // get the url
            $menu->url = $request->url;
        }
        $menu->target = $request->target;
        // $menu->order = $menu->highestOrderMenuItem();
        $menu->save();
        return redirect(route('admin.menus.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu = $menu;
        $menu->delete();

        return redirect(route('admin.menus.index'))->with('success', 'Deleted Successfully');
    }
}
