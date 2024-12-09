@extends('layouts.app')

@php
    use Carbon\Carbon;
    $localTime = Carbon::now()->locale('uz_UZ')->translatedFormat('Y-m-d H:i:s');
@endphp

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
        .btn-custom {
            font-weight: bold;
            padding: 12px 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Tugma ranglari */
        .btn-warning-custom {
            background-color: #ffc107;
            border: none;
            color: #fff;
        }

        .btn-warning-custom:hover {
            background-color: #e0a800;
        }

        .btn-danger-custom {
            background-color: #dc3545;
            border: none;
            color: #fff;
        }

        .btn-danger-custom:hover {
            background-color: #c82333;
        }

        .btn-primary-custom {
            background-color: #007bff;
            border: none;
            color: #fff;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
        }

        /* Kartalar uchun stil */
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>

<div class="container mt-5">
    <h2 class="text-center mb-4">So'rovnomalar</h2>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach($polls as $poll)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{ $poll->title }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($poll->description, 100) }}</p>
                        <p> <span>By :</span> {{ $poll->user->email }}</p>

                        @if ($poll->end_time > $localTime)
                            <p class="text-info mt-3">
                                <i class="fas fa-calendar-alt"></i> Yaratilgan vaqt: <strong>{{ $poll->created_at->format('Y-m-d') }}</strong>
                            </p>
                            <p class="text-info mt-3">
                                <i class="fas fa-calendar-alt"></i> Oxirgi o'zgartirilgan vaqt: <strong>{{ $poll->updated_at->format('Y-m-d') }}</strong>
                            </p>
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <!-- Yangilash tugmasi -->
                                        <a href="{{ route('update', $poll->id) }}" class="btn btn-warning-custom btn-block text-white mb-2">
                                            <i class="fas fa-edit"></i> Yangilash
                                        </a>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <!-- O'chirish formasi -->
                                        <form action="{{ route('polls.destroy', $poll->id) }}" method="POST" onsubmit="return confirm('Siz rostdan ham o‘chirmoqchimisiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custom btn-block">
                                                <i class="fas fa-trash"></i> O'chirish
                                            </button>
                                        </form>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <!-- Ovozlarni ko'rish tugmasi -->
                                        <button type="button" class="btn btn-primary-custom btn-block" data-bs-toggle="modal" data-bs-target="#voteModal{{ $poll->id }}" data-poll-id="{{ $poll->id }}">
                                            <i class="fas fa-eye"></i> Ovozlarni ko'rish
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @else
                            <p class="text-danger text-center mt-3">So'rovnoma yakunlandi</p>
                            <div class="container mt-5">
                            
                                <div class="row">
                                <div class="col-md-12 mb-3">
                                        <!-- O'chirish formasi -->
                                        <form action="{{ route('polls.destroy', $poll->id) }}" method="POST" onsubmit="return confirm('Siz rostdan ham o‘chirmoqchimisiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custom btn-block">
                                                <i class="fas fa-trash"></i> O'chirish
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <div class="col-md-12 mb-3">
                                    <button type="button" class="btn btn-primary-custom btn-block" data-bs-toggle="modal" data-bs-target="#voteModal{{ $poll->id }}" data-poll-id="{{ $poll->id }}">
                                        <i class="fas fa-eye"></i> Ovozlarni ko'rish
                                    </button>
                                    </div>
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="voteModal{{ $poll->id }}" tabindex="-1" aria-labelledby="voteModalLabel{{ $poll->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content shadow-lg border-0">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="voteModalLabel{{ $poll->id }}">
                                <i class="fas fa-poll"></i> Natijalar
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-light p-4">
                            <ul id="pollResults{{ $poll->id }}" class="list-group">
                                <li class="list-group-item">Yuklanmoqda...</li>
                            </ul>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Yopish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('[data-bs-toggle="modal"]');
        modals.forEach(function (modalTrigger) {
            modalTrigger.addEventListener('click', function () {
                const pollId = this.getAttribute('data-poll-id');
                const resultsList = document.getElementById(`pollResults${pollId}`);
                const modalTitle = document.getElementById(`voteModalLabel${pollId}`);

                // Ma'lumotlarni tozalash
                resultsList.innerHTML = '<li class="list-group-item">Yuklanmoqda...</li>';

                // AJAX orqali ma'lumotlarni olish
                fetch(`/polls/${pollId}/results`)
                    .then(response => response.json())
                    .then(data => {
                        modalTitle.textContent = data.poll.title;

                        // Javoblarni ko'rsatish
                        resultsList.innerHTML = '';
                        data.answers.forEach(answer => {
                            const listItem = document.createElement('li');
                            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                            listItem.innerHTML = `
                                <span>${answer.answer}</span>
                                <span class="badge bg-primary rounded-pill">${answer.votes_count} ta ovoz</span>
                            `;
                            resultsList.appendChild(listItem);
                        });
                    })
                    .catch(error => {
                        resultsList.innerHTML = '<li class="list-group-item text-danger">Xatolik yuz berdi!</li>';
                        console.error('Xatolik:', error);
                    });
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

@endsection
