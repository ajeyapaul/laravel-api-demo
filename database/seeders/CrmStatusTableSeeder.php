<?php

namespace Database\Seeders;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'name'       => 'Lead',
                'created_at' => '2024-07-12 11:56:10',
                'updated_at' => '2024-07-12 11:56:10',
            ],
            [
                'name'       => 'Customer',
                'created_at' => '2024-07-12 11:56:10',
                'updated_at' => '2024-07-12 11:56:10',
            ],
            [
                'name'       => 'Partner',
                'created_at' => '2024-07-12 11:56:10',
                'updated_at' => '2024-07-12 11:56:10',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
