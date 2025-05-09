<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSedeer extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permision = [
            'read news',
            'create news',
            'update news',
            'delete news',

        ];
        foreach ($permision as $item) {
            Permission::create(['name' => $item]);
        }
        $author = Role::create(['name' => 'author']);
        $editor = Role::create(['name' => 'editor']);

        $author->givePermissionTo('read news');
        $author->givePermissionTo('create news');
        $author->givePermissionTo('update news');
        $author->givePermissionTo('delete news');

        $editor->givePermissionTo('read news');
    }
}
