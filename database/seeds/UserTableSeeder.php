<?php

use Illuminate\Database\Seeder;
use Membra\User;
  
class UserTableSeeder extends Seeder {
  
	public function run() {

		// Create Users
		Sentinel::registerAndActivate([
			'email' 		=> 'd@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'Daniel',
			'lastname'	 	=> 'SADMIN',
			'username' 		=> 'sadmin',
		]);
		Sentinel::registerAndActivate([
			'email' 		=> 'test@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'lastname'	 	=> 'ADMIN',
			'username' 		=> 'admin',
		]);
		Sentinel::registerAndActivate([
			'email' 		=> 'test2@rtrdt.ch',
			'password' 		=> '12345678', // Den hash'r automatisk
			'firstname' 	=> 'John',
			'lastname'	 	=> 'MOD',
			'username' 		=> 'mod',
		]);

		//Create Roles
		$role = Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Moderators',
		    'slug' => 'mod',
		]);
		$role = Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Administrators',
		    'slug' => 'admin',
		]);
		$role = Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Super Administrators',
		    'slug' => 'superadmin',
		]);

		// Add users to groups
		$user = Sentinel::findById(1);
		$role = Sentinel::findRoleByName('Super Administrators');
		$role->users()->attach($user);

		$user = Sentinel::findById(2);
		$role = Sentinel::findRoleByName('Administrators');
		$role->users()->attach($user);

		$user = Sentinel::findById(3);
		$role = Sentinel::findRoleByName('Moderators');
		$role->users()->attach($user);

		//Add permissions to roles
		$role = Sentinel::findRoleByName('Super Administrators');

		$role->addPermission('admin');//admin panel access

		$role->addPermission('admin.news.create');
		$role->addPermission('admin.news.update');
		$role->addPermission('admin.news.destroy');
		$role->addPermission('admin.news.restore');

		$role->addPermission('admin.newscategories.create');
		$role->addPermission('admin.newscategories.update');
		$role->addPermission('admin.newscategories.destroy');
		$role->addPermission('admin.newscategories.restore');

		$role->save();


		$role = Sentinel::findRoleByName('Administrators');

		$role->addPermission('admin');//admin panel access

		$role->addPermission('admin.news.create');
		$role->addPermission('admin.news.update');
		$role->addPermission('admin.news.destroy');
		$role->addPermission('admin.news.restore', false);

		$role->addPermission('admin.newscategories.create');
		$role->addPermission('admin.newscategories.update');
		$role->addPermission('admin.newscategories.destroy');
		$role->addPermission('admin.newscategories.restore', false);

		$role->save();


		$role = Sentinel::findRoleByName('Moderators');

		$role->addPermission('admin');//admin panel access

		$role->addPermission('admin.news.create', false);
		$role->addPermission('admin.news.update');
		$role->addPermission('admin.news.destroy', false);
		$role->addPermission('admin.news.restore', false);

		$role->addPermission('admin.newscategories.create', false);
		$role->addPermission('admin.newscategories.update', false);
		$role->addPermission('admin.newscategories.destroy', false);
		$role->addPermission('admin.newscategories.restore', false);

		$role->save();

	}
}