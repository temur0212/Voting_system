@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" id="success-alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Alert -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" id="error-alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- User List Card -->
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-primary text-white rounded-top d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-users me-2"></i>Foydalanuvchilar Ro'yxati</h4>
            <!-- Search Form -->
            <form action="{{ route('admin.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Email qidirish..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="card-body p-4">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->roles->pluck('name')->join(', ') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning  me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Auto Dismiss Alert Script -->
<script>
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        if (successAlert) {
            successAlert.classList.remove('show');
            successAlert.classList.add('fade');
            setTimeout(() => successAlert.remove(), 150);
        }
        if (errorAlert) {
            errorAlert.classList.remove('show');
            errorAlert.classList.add('fade');
            setTimeout(() => errorAlert.remove(), 150);
        }
    }, 3000); // 3 seconds
</script>

@endsection
