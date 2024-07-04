<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AffiliatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('affiliates')->delete();
        DB::statement('ALTER TABLE affiliates AUTO_INCREMENT = 1;');
        DB::table('affiliates')->insert([
            [
                'name' => 'Affiliate 1',
                'email' => 'affiliate1@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Affiliate 2',
                'email' => 'affiliate2@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Affiliate 3',
                'email' => 'affiliate3@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Affiliate 4',
                'email' => 'affiliate4@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Affiliate 5',
                'email' => 'affiliate5@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Affiliate 6',
                'email' => 'affiliate6@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
