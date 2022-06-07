<?php

namespace Suppliers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Suppliers\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('suppliers')->count() == 0) {
            Supplier::create([
                'name' => 'supplier',
                'email' => 'supplier@supplier.supplier',
                'password' => bcrypt('123'),
            ]);
        }

    }
}
