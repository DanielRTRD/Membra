<?php

use Illuminate\Database\Seeder;
use App\User as User;
  
class UserTableSeeder extends Seeder {
  
    public function run() {
        User::truncate();
  
        User::create( [
            'email' => 'd@rtrdt.ch',
            'password' => Hash::make('admin'),
            'name' => 'Daniel',
            'username' => 'admin',
        ] );
    }
}