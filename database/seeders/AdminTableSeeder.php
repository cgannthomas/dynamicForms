<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dateNow = now();
        $userList = array(
            [
                'name' => 'Admin',
                'email' => 'admin@dynamicforms.com',
                'password' => Hash::make('Password#Admin'),
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
        );
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        Schema::enableForeignKeyConstraints();
        Admin::insert($userList);
    }
}
