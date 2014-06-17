<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Eloquent::unguard();

		// // $this->call('UserTableSeeder');

		DB::table('admin')->insert([
                'username'   => 'admin',
                'email'      => 'admin@admin.com',
                'password'   => Hash::make('admin'),
                'first_name' => 'ร้านริน',
                'last_name'  => 'ขนมหวาน',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
	}

}
