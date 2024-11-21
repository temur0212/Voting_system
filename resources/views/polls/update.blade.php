@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="fas fa-edit"></i> So'rovnomani yangilash</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('polls.edit', $poll->id) }}" method="PUT">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title"><i class="fas fa-heading"></i> Sarlavha:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $poll->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description"><i class="fas fa-align-left"></i> Tavsif:</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $poll->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="end_time"><i class="fas fa-calendar-times"></i> Tugash vaqti:</label>
                            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ \Carbon\Carbon::parse($poll->end_time)->format('Y-m-d H:i:s') }}" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save"></i> Yangilash
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
