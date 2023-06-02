<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            // [
            //     'year' => 2020,
            //     'Name' => 'Membership Account',
            //     'Code' => 'MS',
            //     'AnualPrinciple' => 180000
            // ],
            // [
            //     'year' => 2020,
            //     'Name' => 'Welfare Account',
            //     'Code' => 'WS',
            //     'AnualPrinciple' => 200000
            // ],
            // [
            //     'year' => 2020,
            //     'Name' => 'Party Account',
            //     'Code' => 'PS',
            //     'AnualPrinciple' => 60000
            // ],

            [
                'year' => 2023,
                'Name' => 'Membership Account',
                'Code' => 'MS',
                'AnualPrinciple' => 180000
            ],
            [
                'year' => 2023,
                'Name' => 'Welfare Account',
                'Code' => 'WS',
                'AnualPrinciple' => 200000
            ],
            [
                'year' => 2023,
                'Name' => 'Party Account',
                'Code' => 'PS',
                'AnualPrinciple' => 60000
            ],

            // [
            //     'year' => 2023,
            //     'Name' => 'Project Fund 03',
            //     'Code' => 'P03',
            //     'AnualPrinciple' => 1030000
            // ]
        ];

        foreach ($accounts as $account) {
            Account::create($account);
        }
    }
}
