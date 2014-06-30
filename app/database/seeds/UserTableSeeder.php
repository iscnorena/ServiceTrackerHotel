<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

use ServiceTracker\Entities\User;

//use User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		User::create([
               'full_name' => 'Administrator',
               'username'  => 'admin',
               //'username'  => $faker->randomElement(['CNORENA', 'JFLORES', 'MCARRANZA','SASTUDILLO','MBAHENA','EVARGAS','GTORRES','AARGUELLO','MCASTREJON','ALLAVES']),
               'email'     => 'admin@cpacapulco.com',
               'password'  => 'admin',
               'type'      => 'admin'
            ]);

		foreach(range(1, 10) as $index)
		{
			$fullName = $faker->name;

            User::create([
               'full_name' => $fullName,
               'username'  => $faker->userName,
               //'username'  => $faker->randomElement(['CNORENA', 'JFLORES', 'MCARRANZA','SASTUDILLO','MBAHENA','EVARGAS','GTORRES','AARGUELLO','MCASTREJON','ALLAVES']),
               'email'     => $faker->email,
               'password'  => '1234',
               'type'      => 'usuario'
            ]);

			
		}
	}
}

