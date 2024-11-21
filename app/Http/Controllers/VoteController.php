<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function vote(Request $request, $pollId)
    {
    
        $poll = Poll::findOrFail($pollId);

        
        $answerId = $request->input('vote');

        
        $existingVote = Vote::where('poll_id', $poll->id)
                            ->where('user_id', auth()->id())
                            ->first();

        if ($existingVote) {
            
            return redirect()->route('polls.index')
                             ->with('error', 'Siz allaqachon ovoz bergansiz!');
        } else {
            
            Vote::create([
                'poll_id' => $poll->id,
                'user_id' => auth()->id(),
                'answer_id' => $answerId,
            ]);
            
            return redirect()->route('polls.index')
                             ->with('success', 'Ovoz muvaffaqiyatli berildi!');
        }
    }
}
