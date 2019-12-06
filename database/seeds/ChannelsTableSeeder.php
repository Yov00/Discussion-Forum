<?php

use Illuminate\Database\Seeder;
use App\Channel;
class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
        'name' => 'Laravel 6.2',
        'slug' => str_slug('Laravel 6.2'),
       ]);

       Channel::create([
        'name' => 'Vue JS 3',
        'slug' => str_slug('Vue JS 3'),
       ]);

       Channel::create([
        'name' => 'Angular 7',
        'slug' => str_slug('Angular 7'),
       ]);

       Channel::create([
        'name' => 'PHP 7 Power',
        'slug' => str_slug('PHP 7 Power'),
       ]);
    }
}
