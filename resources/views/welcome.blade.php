<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ovoz Berish Tizimi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Bosh rang palitrasi */
        :root {
            --primary-color: #007bff;  /* Asosiy rang */
            --secondary-color: #28a745; /* Ikkinchi darajali rang */
            --dark-color: #343a40;
            --light-color: #fefeff;
            --accent-color: #ffc107;
        }

        /* Asosiy header qismi */
        header {
            background-color: var(--dark-color);
            padding: 1rem 0;
        }

        header a.navbar-brand {
            font-size: 1.5rem;
        }

        /* Qisqa ta'rif qismi */
        section.bg-info {
            background-color: var(--primary-color) !important;
            color: #fefeff;
        }

        section.bg-info h1 {
            font-weight: 700;
            letter-spacing: 1px;
        }

        section.bg-info a.btn {
            background-color: #fefeff;
            border: none;
            color: var(--dark-color);
            transition: background-color 0.3s ease;
        }

        section.bg-info a.btn:hover {
            background-color: var(--dark-color);
            color: #fefeff;
        }

        /* So'rovnomalar ro'yxati */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card .card-title {
            font-size: 1.25rem;
            color: var(--primary-color);
        }

        .card .card-text {
            font-size: 0.95rem;
            color: var(--dark-color);
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: var(--light-color);
            padding: 1.5rem 0;
        }

        footer p {
            margin: 0;
        }

        /* Hozir ovoz berish va Ovoz berish tugmalari uchun bir xil rang */
       .card .btn-primary {
            background-color: var(--primary-color); /* Asosiy rang */
            border: none;
            color: var(--light-color);
            transition: background-color 0.3s ease;
            padding: 10px 30px;
            border-radius: 50px;
        }

        section.bg-info a.btn:hover, .card .btn-primary:hover {
            background-color: var(--dark-color);
            color: var(--light-color);
        }
    </style>
</head>
<body>

<header>
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="navbar-brand text-white font-weight-bold">
            <i class="fas fa-poll"></i> Ovoz Berish Tizimi
        </a>
        <nav>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('/index') }}" class="rounded-md px-3 py-2 text-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-white">
                            Kirish
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-white">
                                Ro'yxatdan o'tish
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </nav>
    </div>
</header>

<section class="bg-info text-center text-white py-5">
    <div class="container">
        <h1 class="display-4">Har bir ovoz muhim!</h1>
        <p class="lead">Bizning yangi so'rovnomalarimizda qatnashib, o'z ovozingizni bildiring!</p>
        <a href="/index" class="btn btn-lg mt-4">Hozir ovoz berish</a>
    </div>
</section>

<section class="my-5">
    <div class="container">
        <h2 class="text-center font-weight-bold mb-4">Eng So'ngi So'rovnomalar</h2>
        <div class="row">
            @foreach($polls->take(3) as $poll) <!-- Faqat 3ta so'rovni ko'rsatish uchun $polls kolleksiyasidan foydalanamiz -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-light rounded d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <!-- So'rov sarlavhasi -->
                            <h5 class="card-title font-weight-bold">{{ $poll->title }}</h5>
                            <!-- So'rov tavsifini qisqartirish (100 ta belgi) -->
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($poll->description, 100) }}</p>
                            <!-- So'rov yaratish sanasi -->
                            <p class="text-info mt-3">
                                <i class="fas fa-calendar-alt"></i> Yaratilgan vaqt: <strong>{{ $poll->created_at->format('Y-m-d') }}</strong>
                            </p>
                            <!-- So'rov oxirgi o'zgartirilgan vaqti -->
                            <p class="text-info mt-3">
                                <i class="fas fa-calendar-alt"></i> Oxirgi o'zgartirilgan vaqt: <strong>{{ $poll->updated_at->format('Y-m-d') }}</strong>
                            </p>
                            <!-- Ovoz berish tugmasi -->
                            <a href="{{ route('polls.show', $poll->id) }}" class="btn btn-primary mt-auto">
                                <i class="fas fa-vote-yea"></i> Ovoz berish
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer>
    <div class="container text-center">
        <p>&copy; 2024 Ovoz Berish Tizimi. Barcha huquqlar himoyalangan.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
