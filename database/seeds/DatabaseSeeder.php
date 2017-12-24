<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call('UserTableSeeder');

		// Disable foreign key checking because truncate() will fail
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		$hasher = app()->make('hash');
		\App\User::truncate();
		\App\User::create(array(
			'name' => 'Admin',
			'email' => 'admin@domain.dev',
			'password' => $hasher->make('admin123'),
			'is_admin' => 1
		));
		\App\User::create(array(
			'name' => 'User',
			'email' => 'user@domain.dev',
			'password' => $hasher->make('user123'),
			'is_admin' => 0
		));

		// Enable it back
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}
