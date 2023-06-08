<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Product::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'shabi',
            'email' => 'shabi.dev@gmail.com',
            'password' => Hash::make('qwer1234')
        ]);
        
    }
}
