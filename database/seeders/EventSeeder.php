<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactiontypes = ['Pay', 'Receive'];
        foreach ($transactiontypes as $transactiontype) {
            Event::create(['Event' => $transactiontype]);
        }
    }
}
