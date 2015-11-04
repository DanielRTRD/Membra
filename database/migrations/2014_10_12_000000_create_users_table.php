<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('firstname');
			$table->string('lastname');
			$table->string('username')->unique();
			$table->string('email');
			
			$table->string('password');
			$table->string('passwordtoken');

			$table->string('gender');
			$table->string('location');
			$table->string('address'); // Google Maps location
			$table->string('occupation');

			$table->string('profilepicture')->nullable();
			$table->string('profilepicturesmall')->nullable();
			$table->string('profilecover')->nullable();
			$table->string('referral');
			$table->string('referral_code');
			$table->string('activation_code');

			$table->string('userdateformat')->default('d. M Y');
			$table->string('usertimeformat')->default('H:i');
			$table->enum('showemail', array(0, 1))->default(0);
			$table->enum('showname', array(0, 1))->default(1);
			$table->enum('showonline', array(0, 1))->default(1);


			$table->integer('active')->default(0);
			$table->integer('creator_id')->default(0); //who created it?
			$table->integer('author_id')->default(0); //who updated it?
			$table->timestamp('last_activity')->default(0);

			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
