<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\BillCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $billCategories = ['Electricity','Water','Gas','Maintenance','Service Charge'];
        $owners = User::where('role', UserRoleEnum::OWNER)->get();

        foreach ($owners as $key => $owner) {
            foreach ($billCategories as $key => $billCategory) {
                BillCategory::create([
                    'owner_id' => $owner->id,
                    'name' => $billCategory,
                ]);
            }
        }
    }
}
