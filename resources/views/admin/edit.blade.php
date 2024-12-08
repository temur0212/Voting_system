@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded">
                <div class="card-header bg-gradient-primary text-white rounded-top">
                    <h4 class="text-center mb-0">Edit User Details</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                    
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-bold">Assign Role</label>
                            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" @if($user->roles->contains($role)) selected @endif>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff, #0056b3);
    }

    .btn-primary {
        background: linear-gradient(90deg, #0069d9, #004085);
        border: none;
        transition: background 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #0056b3, #00376d);
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        border-color: #007bff;
    }

    .card {
        border-radius: 15px;
    }
</style>
@endsection
