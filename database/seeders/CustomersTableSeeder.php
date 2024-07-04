<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->delete();
        DB::statement('ALTER TABLE customers AUTO_INCREMENT = 1;');
        DB::table('customers')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john1@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe 2',
                'email' => 'john2@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe 3',
                'email' => 'john3@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe 4',
                'email' => 'john4@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe 5',
                'email' => 'john5@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
