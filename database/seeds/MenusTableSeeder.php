<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('menus')->insert([
            'parent_id' => '0',
            'name'      => '系统管理',
            'url'       => '/',
            'icon'      => 'fa',
            'status'    => 1,
        ]);
        \Illuminate\Support\Facades\DB::table('menus')->insert([
            'parent_id' => '1',
            'name'      => '菜单管理',
            'url'       => '/menu',
            'component' => 'menuPage',
            'alias'     => 'name',
            'icon'      => 'fa',
            'status'    => 1,
        ]);

    }
}
