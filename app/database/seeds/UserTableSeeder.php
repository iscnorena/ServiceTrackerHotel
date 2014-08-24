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
               'full_name' => 'Administrador',
               'username'  => 'admin',
               //'username'  => $faker->randomElement(['CNORENA', 'JFLORES', 'MCARRANZA','SASTUDILLO','MBAHENA','EVARGAS','GTORRES','AARGUELLO','MCASTREJON','ALLAVES']),
               'email'     => 'admin@cpacapulco.com',
               'password'  => 'admin',
               'type'      => 'superadmin'
            ]);

		foreach(range(1, 1) as $index)
		{
			$fullName = $faker->name;

            User::create([
               'full_name' => $fullName,
               'username'  => $faker->userName,
               'view'  => $faker->randomElement(['amadellaves', 'recepcion', 'telefonos', 'mantenimiento','sistemas']),
               'email'     => $faker->email,
               //'password'  => Hash::make('1234'),
               'password'  => '1234',
               'type'      => 'usuario'
            ]);

			
		}
	}
}

