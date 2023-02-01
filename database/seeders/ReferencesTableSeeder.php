<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\Seeder;

class ReferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code' => 'overtime_method',
                'name' => 'Salary / 173',
                'expression' => '(salary / 173) * overtime_duration_total',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'code' => 'overtime_method',
                'name' => 'Fixed',
                'expression' => '10000 * overtime_duration_total',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'code' => 'employee_status',
                'name' => 'Tetap',
                'expression' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'code' => 'employee_status',
                'name' => 'Percobaan',
                'expression' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        Reference::insert($data);
    }
}
