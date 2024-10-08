<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\User;
use App\Models\Cashbook;
use Illuminate\Database\Seeder;
use Carbon\CarbonPeriod;

class CashbookSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->has(
            Customer::factory(10)->has(
               Cashbook::factory(20)
            )
        )->create();
    }
}
