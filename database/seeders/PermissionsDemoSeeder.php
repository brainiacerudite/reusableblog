<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'browse admin']);
        Permission::create(['name' => 'edit settings']);
        Permission::create(['name' => 'read settings']);
        $array = array('categories', 'comments', 'menus', 'pages', 'posts', 'tags', 'users', 'administrators', 'roles', 'permissions', 'banners');
        foreach ($array as $key => $value) {
            Permission::create(['name' => 'browse ' . $value]);
            Permission::create(['name' => 'read ' . $value]);
            Permission::create(['name' => 'edit ' . $value]);
            Permission::create(['name' => 'add ' . $value]);
            Permission::create(['name' => 'delete ' . $value]);
        }
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'browseall posts']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'superadmin']);
        $role1->givePermissionTo(Permission::all());
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo(Permission::all());

        $role3 = Role::create(['name' => 'writer']);
        $role3->givePermissionTo('browse admin');
        $role3->givePermissionTo('browse posts');
        $role3->givePermissionTo('read posts');
        $role3->givePermissionTo('edit posts');
        $role3->givePermissionTo('add posts');
        $role3->givePermissionTo('delete posts');

        $role4 = Role::create(['name' => 'normaluser']);


        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example Superadmin User',
            'email' => 'superadmin@gmail.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@gmail.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Writer User',
            'email' => 'writer@gmail.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Normal User',
            'email' => 'normaluser@gmail.com',
        ]);
        $user->assignRole($role4);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'user@gmail.com',
        ]);
    }
}
