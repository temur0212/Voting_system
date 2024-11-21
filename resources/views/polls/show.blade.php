@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-primary text-white text-center font-weight-bold py-4">
            <i class="fas fa-poll-h mr-2"></i> {{ $poll->title }}
        </div>
        <div class="card-body">
            <p class="text-muted text-center mb-4">
                <i class="fas fa-info-circle mr-1"></i> {{ $poll->description }}
            </p>

            <!-- Xabarlar: muvaffaqiyatli yoki xatolik -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Ovoz berish formasi -->
            <form action="{{ route('polls.vote', $poll->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @foreach ($poll->answers as $answer)
                            <div class="form-check mb-3 p-3 bg-light rounded border">
                                <input class="form-check-input" type="radio" name="vote" id="answer{{ $answer->id }}" value="{{ $answer->id }}" required>
                                <label class="form-check-label ml-3" for="answer{{ $answer->id }}">
                                <i class="fas fa-check-circle text-success mr-2"></i>{{ $answer->answer }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg w-50 mt-4 shadow">
                        <i class="fas fa-vote-yea"></i> Ovoz berish
                    </button>
                </div>
            </form>

            <!-- Natijalar -->
            <div class="results-section">
                <h5 class="text-center font-weight-bold text-secondary mt-5 mb-4">
                    <i class="fas fa-chart-bar mr-2"></i>Natijalar:
                </h5>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <ul class="list-group">
                            @foreach ($answersWithVotes as $answer)
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light shadow-sm p-3 rounded mb-2">
                                    <span><i class="fas fa-check-circle text-success mr-2"></i>{{ $answer->answer }}</span>
                                    <span class="badge badge-primary badge-pill">
                                        <i class="fas fa-vote-yea"></i> {{ $answer->votes_count }} ta ovoz
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
