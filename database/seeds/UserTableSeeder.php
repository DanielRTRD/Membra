<?php

use Illuminate\Database\Seeder;
use Membra\User as User;
  
class UserTableSeeder extends Seeder {
  
	public function run() {

		Sentinel::registerAndActivate([
			'email' 		=> 'd@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'Daniel',
			'lastname'	 	=> 'Billing',
			'username' 		=> 'admin',
		]);

		Sentinel::registerAndActivate([
			'email' 		=> 'test@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'username' 		=> 'test',
		]);

	}
}