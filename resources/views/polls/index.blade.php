@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">So'rovnomalar</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="success-alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="input-group mb-4">
        <input type="text" id="search" class="form-control" placeholder="So'rovnoma nomini kiriting...">
        <div class="input-group-append">
            <span class="input-group-text bg-primary text-white">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>

    <div class="row" id="pollList">
        @foreach($polls as $poll)
        <div class="col-md-4 mb-4 contact">
            <div class="card shadow-lg h-100 border-light rounded d-flex flex-column">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold">{{ $poll->title }}</h5>
                    <p class="card-text text-muted flex-grow-1">{{ Str::limit($poll->description, 100) }}</p>
                    <p class="text-info mt-3">
                        <i class="fas fa-calendar-alt"></i> Yaratilgan vaqt: <strong>{{ $poll->created_at->format('Y-m-d') }}</strong>
                    </p>
                    <p class="text-info mt-3">
                        <i class="fas fa-calendar-alt"></i> Oxirgi o'zgartirilgan vaqt: <strong>{{ $poll->updated_at->format('Y-m-d') }}</strong>
                    </p>
                    <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#voteModal{{ $poll->id }}">
                        <i class="fas fa-vote-yea"></i> Ovoz berish
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal uchun kod -->
        <div class="modal fade" id="voteModal{{ $poll->id }}" tabindex="-1" aria-labelledby="voteModalLabel{{ $poll->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-3">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title w-100 text-center" id="voteModalLabel{{ $poll->id }}">
                            <i class="fas fa-poll"></i> {{ $poll->title }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light p-4">
                        <h5 class="text-center mb-4">{{ $poll->description }}</h5>
                        <form action="{{ route('polls.vote', $poll->id) }}" method="POST">
                            @csrf
                            @foreach ($poll->answers as $answer)
                                <div class="form-check mb-3 p-3 bg-white rounded-3 border border-primary shadow-sm">
                                    <input class="form-check-input" type="radio" name="vote" id="answer{{ $answer->id }}" value="{{ $answer->id }}" required>
                                    <label class="form-check-label fw-semibold" for="answer{{ $answer->id }}">
                                        {{ $answer->answer }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 shadow rounded-pill">
                                    <i class="fas fa-check-circle"></i> Tasdiqlash
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

<script>
    document.getElementById('search').addEventListener('input', (event) => {
        let searchQuery = event.target.value.toLowerCase();
        document.querySelectorAll('.contact').forEach(item => {
            let title = item.querySelector('.card-title').innerText.toLowerCase();
            if (title.includes(searchQuery)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.remove('show'); 
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 150); 
            }
        }, 3000); // 3 seconds

       
    
</script>

@endsection
