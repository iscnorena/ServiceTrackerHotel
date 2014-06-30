<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

use ServiceTracker\Entities\Category;
//use Category;
class CategoryTableSeeder extends Seeder {

	public function run()
	{

		Category::create([
	           'id'   => 1,
	           'name' => 'Ama de Llaves',
	           'slug' => 'amadellaves'
	        ]);

	        Category::create([
	            'id'   => 2,
	            'name' => 'Areas Publicas',
	            'slug' => 'areaspublicas'
	        ]);

	        Category::create([
	            'id'   => 3,
	            'name' => 'AyB',
	            'slug' => 'ayb'
	        ]);

	        Category::create([
	            'id'   => 4,
	            'name' => 'Mantenimiento',
	            'slug' => 'mantenimiento'
	        ]);

	        Category::create([
	            'id'   => 5,
	            'name' => 'Recepcion',
	            'slug' => 'recepcion'
	        ]);

	        Category::create([
	            'id'   => 6,
	            'name' => 'Sistemas',
	            'slug' => 'sistemas'
	        ]);

	        Category::create([
	            'id'   => 7,
	            'name' => 'Telefonos',
	            'slug' => 'telefonos'
	        ]);

	}
}

