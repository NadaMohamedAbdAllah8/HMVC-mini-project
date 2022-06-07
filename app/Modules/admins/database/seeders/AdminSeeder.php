<?php

namespace Admins\Database\Seeders;

use Admins\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('admins')->count() == 0) {
            Admin::create([
                'name' => 'admin',
                'email' => 'admin@admin.admin',
                'password' => bcrypt('123'),
            ]);
        }

    }
}