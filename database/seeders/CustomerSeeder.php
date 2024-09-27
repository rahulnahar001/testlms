<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\CarbonPeriod;

class CustomerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $start = now()->startOfMonth()->subMonthsNoOverflow();
        $end = now();
        $period = CarbonPeriod::create($start, '1 day', $end);

        User::factory(5)->create()->each(function ($user) use($period) {
            foreach ($period as $date) {
                $date->hour(rand(0, 23))->minute(rand(0, 6) * 10);

                Customer::factory(10)->create([
                    'user_id' => $user->id,
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
            }
        });
    }
}
