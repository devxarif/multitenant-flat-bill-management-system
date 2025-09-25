<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = Building::all();

        foreach ($buildings as $building) {
            if (rand(0, 100) < 70) {
                Tenant::factory()->create([
                    'building_id' => $building->id,
                ]);
            }
        }
    }
}
