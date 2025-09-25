<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Flat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = Building::all();

        foreach ($buildings as $building) {
            Flat::factory()
                ->count(10)
                ->create([
                    'building_id' => $building->id,
                ]);
        }
    }
}
