<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
     

    protected $fillable = ['title', 'description', 'user_id','start_time','end_time'];


        
        public function user()
        {
            return $this->belongsTo(User::class); // Poll yaratuvchisi
        }

        public function answers()
        {
            return $this->hasMany(Answer::class);
        }
        
        public function votes()
        {
            return $this->hasMany(Vote::class);
        }
        
}
