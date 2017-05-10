<?php

use Illuminate\Database\Seeder;
use App\Idea;
use App\User;

class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ideas = [
            ['iPhone 9', 'Best iPhone ever', 'Ideating', 'Jill TestUser'],
            ['VR Headset', 'VR headset for pre-K learning', 'Concepting Phase', 'Jill TestUser'],
            ['IoT Device', 'A bed with sensors that can show sleep quality', 'Committing',  'Jamal TestUser'],
            ['AR GPS', 'Augumented reality GPS for your car', 'Validating', 'Jamal TestUser'],
        ];

        # Initiate a new timestamp for created_at/updated_at fields
        $timestamp = Carbon\Carbon::now()->subDays(count($ideas));

        # Associate the ideas with their creators
        # A user can only create an idea on his/her own behalf
        foreach($ideas as $idea) {

            $creator = $idea[3];
            $user_id = User::where('name','=', $creator)->pluck('id')->first();

            # Set the created_at/updated_at for each idea to be one day less than
            # the idea before to obtain unique timestamps for each idea.
            $timestampForThisIdea = $timestamp->addDay()->toDateTimeString();

            Idea::insert([
                'created_at' => $timestampForThisIdea,
                'updated_at' => $timestampForThisIdea,
                'idea_name' => $idea[0],
                'description' => $idea[1],
                'stage' => $idea[2],
                'user_id' => $user_id,
            ]);

          }

      }
}
