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
                'year' => 2021,
                'Name' => 'Membership Account',
                'Code' => 'MS',
                'AnualPrinciple' => 180000
            ],
            [
                'year' => 2021,
                'Name' => 'Welfare Account',
                'Code' => 'WS',
                'AnualPrinciple' => 200000
            ],
            [
                'year' => 2021,
                'Name' => 'Party Account',
                'Code' => 'PS',
                'AnualPrinciple' => 60000
            ],

            [
                'year' => 2022,
                'Name' => 'Membership Account',
                'Code' => 'MS',
                'AnualPrinciple' => 180000
            ],
            [
                'year' => 2022,
                'Name' => 'Welfare Account',
                'Code' => 'WS',
                'AnualPrinciple' => 200000
            ],
            [
                'year' => 2022,
                'Name' => 'Party Account',
                'Code' => 'PS',
                'AnualPrinciple' => 60000
            ],
        ];

        foreach ($accounts as $account) {
            Account::create($account);
        }
    }
}
