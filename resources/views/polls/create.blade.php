@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white text-center font-weight-bold">
                    <i class="fas fa-poll-h"></i> So'rovnoma yaratish
                </div>
                <div class="card-body">
                    <form action="{{ route('polls.store') }}" method="POST">
                        @csrf
                        
                        <!-- Sarlavha maydoni -->
                        <div class="form-group">
                            <label for="title">Sarlavha:</label>
                            <input type="text" name="title" class="form-control form-control-lg" required>
                        </div>

                        <!-- Tavsif maydoni -->
                        <div class="form-group">
                            <label for="description">Tavsif:</label>
                            <textarea name="description" class="form-control form-control-lg" rows="3"></textarea>
                        </div>

                        <!-- Boshlanish vaqti maydoni -->
                        <div class="form-group">
                            <label for="start_time" class="font-weight-bold">Boshlanish vaqti:</label>
                            <input type="datetime-local" name="start_time" class="form-control form-control-lg" required>
                        </div>

                        <!-- Tugash vaqti maydoni -->
                        <div class="form-group">
                            <label for="end_time">Tugash vaqti:</label>
                            <input type="datetime-local" name="end_time" class="form-control form-control-lg" required>
                        </div>

                        <!-- Javoblar maydoni -->
                        <div id="answers-container">
                            <div class="form-group">
                                <label for="answer_1">Javob 1:</label>
                                <input type="text" name="answers[]" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <!-- Javob qo'shish tugmasi -->
                        <div class="form-group">
                            <button type="button" id="add-answer-btn" class="btn btn-secondary">
                                <i class="fas fa-plus"></i> Javob qo'shish
                            </button>
                        </div>

                        <!-- Yaratish tugmasi -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-plus-circle"></i> Yaratish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let answerIndex = 2; 
    document.getElementById('add-answer-btn').addEventListener('click', function() {
        const newAnswerField = document.createElement('div');
        newAnswerField.classList.add('form-group');
        newAnswerField.innerHTML = `
            <label for="answer_${answerIndex}">Javob ${answerIndex}:</label>
            <input type="text" name="answers[]" class="form-control form-control-lg" required>
        `;
        document.getElementById('answers-container').appendChild(newAnswerField);
        answerIndex++;
    });
</script>

@endsection
