<?php

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('TagTableSeeder');
        $this->command->info('Tag table seeded.');

        $this->call('VideoTableSeeder');
        $this->command->info('Video table seeded.');
    }
}
