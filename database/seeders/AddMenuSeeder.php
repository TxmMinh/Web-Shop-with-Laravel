<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use \App\Models\Menu;

class AddMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('menus')->insert([
                'name' => Str::random(10),
                'parent_id' => 0,
                'description' => Str::random(20),
                'content' => Str::random(50),
                'active' => 1,
            ]);
        }
    }
}
