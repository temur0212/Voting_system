<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class PollController extends Controller
{
    public function index()
{
    $currentTime = Carbon::now();

    $polls = Poll::where('end_time','>',$currentTime )
            ->orderByDesc('created_at')        
            ->get();
    return view('polls.index', compact('polls'));
}

    public function welcom()
{
    $currentTime = Carbon::now();

    $polls = Poll::where('end_time','>',$currentTime )
            ->orderByDesc('created_at')        
            ->get();
    return view('welcome', compact('polls'));
}


    public function create()
    {
        return view('polls.create');
    }


    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'answers' => 'required|array|min:1', 
        'answers.*' => 'required|string|max:255',
    ]);

    
    $poll = Poll::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'user_id' => auth()->id(),
        'start_time' => $request->input('start_time'),
        'end_time' => $request->input('end_time'),
    ]);

    
    foreach ($request->input('answers') as $answerText) {
        $poll->answers()->create([
            'answer' => $answerText,
        ]);
    }

    return redirect()->route('polls.index')->with('success', "So'rovnoma muvaffaqiyatli yaratildi");
}



public function show($id)
{
    $poll = Poll::with('answers')->findOrFail($id);

    // Javoblarning ovozlar sonini olish
    $answersWithVotes = $poll->answers->map(function($answer) use ($poll) {
        $answer->votes_count = $poll->votes()->where('answer_id', $answer->id)->count();
        return $answer;
    });

    return view('polls.show', compact('poll', 'answersWithVotes'));
}

public function getPollResults($id)
{
    $poll = Poll::with('answers')->findOrFail($id);

    // Javoblarning ovozlar sonini hisoblash
    $answersWithVotes = $poll->answers->map(function ($answer) {
        $answer->votes_count = $answer->votes()->count(); // Har bir javobning ovozlari
        return $answer;
    });

    return response()->json([
        'poll' => $poll,
        'answers' => $answersWithVotes,
    ]);
}


    

    public function polls_one(){
        $user=auth()->id();

        $polls = Poll::where('user_id',$user)->orderBy('created_at', 'desc')->get();
        return view('polls.polls_one', compact('polls'));
    }
    
    
    public function edit(Request $request, $id)
{

    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'end_time' => 'required|date',
    ]);

    $poll = Poll::findOrFail($id);
    $poll->update($validatedData);

    return redirect()->route('update', $poll->id)->with('success', 'So‘rovnoma muvaffaqiyatli yangilandi!');

}
   

    public function destroy($id)
{
    // So'rovnomani toping va o'chiring
    $poll = Poll::findOrFail($id);
    $poll->delete();

    return redirect()->route('polls_one')->with('success', "So‘rovnoma muvaffaqiyatli o‘chirildi!");
}


    public function update(Request $request,$id)
{
    $poll = Poll::find($id); 
    return view('polls.update', compact('poll')); 
}
           
        
}

