<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutPage = Page::create([
            'title' => 'About Us',
            'slug' => 'about',
            'body' => '<p>this is the about page.</p>',
            'style' => '',
        ]);

        $menu = Menu::create([
            'title' => 'About',
            'url' => '',
            'route' => 'page',
            'parameters' => '{"page":"about"}',
            'target' => '_self',
            'parent_id' => 0,
            'order' => 1,
        ]);
    }
}
