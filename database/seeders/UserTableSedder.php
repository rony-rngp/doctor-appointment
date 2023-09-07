<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
           'Name' => 'Rony',
           'email' => 'rony.rng@gmail.com',
            'password' => Hash::make(11111111),
            'image' => ''
        ]);
    }
}
