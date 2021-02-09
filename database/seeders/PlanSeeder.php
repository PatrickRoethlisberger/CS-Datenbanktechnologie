<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::insert([
            [
                'name' => 'Bewerbungsphase',
                'description' => 'Um ein vollwertiges Mitglied werden zu können muss zuerst die zweiwöchige Bewerbungsphase abgeschlossen werden.',
                'price' => 299,
                'duration' => 2,
                'lots' => 1,
                'isInitialPlan' => true,
                'isBanningPlan' => false,
            ],
            [
                'name' => 'Standard halbjährlich',
                'description' => 'Ein Standplatz, welcher halbjährlich bezahlt wird',
                'price' => 599,
                'duration' => 6,
                'lots' => 1,
                'isInitialPlan' => false,
                'isBanningPlan' => false,
            ],
            [
                'name' => 'Standard jährlich',
                'description' => 'Ein Standplatz, welcher jährlich bezahlt wird',
                'price' => 999,
                'duration' => 12,
                'lots' => 1,
                'isInitialPlan' => false,
                'isBanningPlan' => false,
            ],
            [
                'name' => 'Pro halbjährlich',
                'description' => 'Drei Standplätze, welcher halbjährlich bezahlt werden',
                'price' => 1299,
                'duration' => 6,
                'lots' => 1,
                'isInitialPlan' => false,
                'isBanningPlan' => false,
            ],
            [
                'name' => 'Verstoss gegen die Richtlinien',
                'description' => 'Aufgrund eines Verstosses gegen unsere Richtlinien musste Ihr Vertrag für drei Monate unterbrochen werden.',
                'price' => 0,
                'duration' => 3,
                'lots' => 0,
                'isInitialPlan' => false,
                'isBanningPlan' => true,
            ],
        ]);
    }
}
