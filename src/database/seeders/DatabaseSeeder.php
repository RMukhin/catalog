<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = include database_path('/data.php');

        DB::table("groups")->insert($data['groups']);
        DB::table("products")->insert($data['products']);
        DB::table("prices")->insert($data['prices']);
    }
}
