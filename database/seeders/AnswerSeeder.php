<?php

namespace Database\Seeders;

use App\Models\Answer;

use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    
    public function run(): void
    {
    
        $polls = [
            [
                'answer' => 'What is Lorem Ipsum?',
                'poll_id' => 1, 
            ],
            [
                'answer' => 'Why do we use it?',
                'poll_id' => 1, 
            ],
            [
                'answer' => 'Where can I get some?',
                'poll_id' => 1, 
            ],
            [
                'answer' => 'What is Lorem Ipsum?',
                'poll_id' => 2, 
            ],
            [
                'answer' => 'Why do we use it?',
                'poll_id' => 2, 
            ],
            [
                'answer' => 'Where can I get some?',
                'poll_id' => 2, 
            ],
        ];

        
        Answer::insert($polls);
    }
}
