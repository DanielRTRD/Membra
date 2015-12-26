<?php

use Illuminate\Database\Seeder;
use Membra\User as User;
  
class UserTableSeeder extends Seeder {
  
	public function run() {
  
		User::create([
			'email' 		=> 'd@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'Daniel',
			'username' 		=> 'admin',
			'active'		=> 1,
			'issuperadmin'	=> 1,
		]);

		User::create([
			'email' 		=> 'test@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'username' 		=> 'test',
		]);

	}
}