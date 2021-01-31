<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            [
                'name' => 'Bewerbungsphase',
                'description' => 'Um ein vollwertiges Mitglied werden zu können muss zuerst die zweiwöchige Bewerbungsphase abgeschlossen werden.',
                'price' => 299,
                'duration' => 2,
                'lots' => 1,
                'isInitialPlan' => true,
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Standard halbjährlich',
                'description' => 'Ein Standplatz, welcher halbjährlich bezahlt wird',
                'price' => 599,
                'duration' => 6,
                'lots' => 1,
                'isInitialPlan' => false,
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Standard jährlich',
                'description' => 'Ein Standplatz, welcher jährlich bezahlt wird',
                'price' => 999,
                'duration' => 12,
                'lots' => 1,
                'isInitialPlan' => false,
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Pro halbjährlich',
                'description' => 'Drei Standplätze, welcher halbjährlich bezahlt werden',
                'price' => 1299,
                'duration' => 6,
                'lots' => 1,
                'isInitialPlan' => false,
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
        ]);
    }
}
