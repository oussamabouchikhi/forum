<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Channel::create([
            'title' => 'Laravel'
        ]);
        Channel::create([
            'title' => 'Javascript'
        ]);
        Channel::create([
            'title' => 'Python'
        ]);
        Channel::create([
            'title' => 'Flutter'
        ]);
    }
}
