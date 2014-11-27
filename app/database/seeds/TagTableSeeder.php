<?php

/**
 * Class TagTableSeeder
 */
class TagTableSeeder extends Seeder
{

    /**
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        Tag::create(array(
            'text' => 'Health',
        ));

        Tag::create(array(
            'text' => 'Food',
        ));

        Tag::create(array(
            'text' => 'Programming',
        ));
    }
}
