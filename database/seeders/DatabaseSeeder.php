<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('Customers\Database\Seeders\CustomerSeeder');
        $this->call('Admins\Database\Seeders\AdminSeeder');
        $this->call('Suppliers\Database\Seeders\SupplierSeeder');

    }
}