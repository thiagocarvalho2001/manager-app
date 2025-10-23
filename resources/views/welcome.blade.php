<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to the APP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
                color: #e5e7eb;
            }
        }

        .hero {
            text-align: center;
            max-width: 700px;
            margin: 8rem auto 3rem auto;
            padding: 0 1rem;
        }

        .hero h1 {
            font-size: 2.75rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: #e5e7eb;
        }

        .hero p {
            font-size: 1.125rem;
            line-height: 1.75rem;
            color: #9ca3af;
        }

        .hero-buttons {
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.75rem;
            border-radius: 9999px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .btn-primary {
            background-color: #6366f1;
            color: white;
        }
        .btn-primary:hover {
            background-color: #4f46e5;
        }

        .btn-outline {
            border: 2px solid #6366f1;
            color: #6366f1;
        }
        .btn-outline:hover {
            background-color: #6366f1;
            color: white;
        }

        footer {
            text-align: center;
            padding: 1rem;
            border-top: 1px solid #2d2f3a;
            background-color: #1a1b26;
            color: #9ca3af;
            font-size: 0.875rem;
            margin-top: 4rem;
        }
    </style>
</head>
<body>
    <main>
        <section class="hero">
            <h1>Take control of your financial life!</h1>
            <p>
                We're here to help you manage your income, expenses, and budgets with ease. Achieve financial balance with a simple and intuitive platform.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn btn-primary">Create your account!</a>
                <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
            </div>
        </section>
    </main>

    <footer>
        © {{ date('Y') }} MangerAPP. All rights reserved.
    </footer>
</body>
</html>
