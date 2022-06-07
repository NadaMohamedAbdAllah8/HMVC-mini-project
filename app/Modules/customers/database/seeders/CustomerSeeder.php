<?php

namespace Customers\Database\Seeders;

use Customers\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('customers')->count() == 0) {
            Customer::create([
                'name' => 'customer',
                'email' => 'customer@customer.customer',
                'password' => bcrypt('123'),
            ]);
        }
    }
}
