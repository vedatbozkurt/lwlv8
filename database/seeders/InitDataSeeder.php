<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Vedat',
            'email' => 'a@a.com',
            'password' => bcrypt('123'),
        ]);

        for ($i=0;$i<5;$i++) {
            \App\Models\Status::create([
                'name' => Str::random(4).'Status',
            ]);
        }

        for ($i=0;$i<25;$i++) {
            \App\Models\Contact::create([
                'name' => 'contact'.$i,
                'phone' => Str::random(4).'Status',
                'status_id' => rand(1, 5),
                'photo' => '',
            ]);
        }
    }
}
