<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();
        $items = array(
        	array(
        		'owner_id' => 1,
        		'name' => 'Pick up milk',
        		'done' => false,
        	),
        	array(
        		'owner_id' => 1,
        		'name' => 'Walk the dogs',
        		'done' => true,
        	),
        	array(
        		'owner_id' => 1,
        		'name' => 'Cook dinner',
        		'done' => false,
        	),
        );

        DB::table('items')->insert($items);
    }
}
