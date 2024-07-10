<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        $packageDays = [7,30,365];
        //$packageDay = 30;
        $currentDate = Carbon::now();
        foreach ($packageDays as $packageDay){
            $endDate = $currentDate->copy()->addDays($packageDay);
            Subscription::create([
                'package_id' => 1,
                'name' => $faker->name(),
                'start_date' => $currentDate,
                'end_date' => $endDate,
                'remaning_day' => $currentDate->diffInDays($endDate),
            ]);
        }

    }
}
