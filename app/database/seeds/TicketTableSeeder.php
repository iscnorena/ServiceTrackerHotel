<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
//use ServiceTracker\Entities\User;
use ServiceTracker\Entities\Ticket;
//use Ticket;

class TicketTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Ticket::create([
				        //'id'          => $user->id,
                'name_guest'  => $faker->name,
                //'room' => $faker->numerify($string = '####'),
                'room'        => $faker->randomElement([1607, 1402, 1502, 1010]),
                'category_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7]),
                'user_id'     => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                'request'     => $faker->randomElement(['caja de seguridad', 'menu', 'control remoto']),
                'notes'       => $faker->text(25),
                'report_by'   => $faker->randomElement(['huesped', 'camarista']),
                'attend_by'   => $faker->randomElement(['jose', 'obdulio','agustin','luis']),
                //'status'      => $faker->randomElement(['resuelto', 'en_proceso','pendiente','cancelado']),
                'status'      => $faker->randomElement(['resuelto', 'en_proceso']),
                //'add_by'      => $user->username
                //'add_by'      => $faker->randomElement(['CNORENA', 'JFLORES', 'MCARRANZA','SASTUDILLO','MBAHENA','EVARGAS','GTORRES','AARGUELLO','MCASTREJON','ALLAVES'])
			]);
		}
	}

}
