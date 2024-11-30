<?php

namespace Database\Seeders;

use App\Models\Poll;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $polls = [
            [
                'title' => 'What is Lorem Ipsum?',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
                'user_id' => 1, 
                'start_time' => now(),
                'end_time' => now()->addDays(7),
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [
                'title' => 'Jahon futbol chempionati haqida fikrlar',
                'description' => 'Jahon futbol chempionati natijalarini baholash uchun ovoz bering!',
                'user_id' => 1, 
                'start_time' => now(),
                'end_time' => now(),
                'created_at' =>now(),
                'updated_at' =>now()
            ],
        ];

        
        Poll::insert($polls);
    }
}
