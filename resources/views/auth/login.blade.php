<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ManagerAPP - Access your account</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --color-primary: #059669;   /* Emerald 600 */
            --color-secondary: #0d9488; /* Teal 600 */
            --color-text-dark: #1f2937;
            --color-bg-light: #f9fafb;
            --color-bg-dark: #111827;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        .form-input-icon {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            padding-left: 0.75rem; /* ps-3 */
            pointer-events: none;
        }
    </style>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden grid md:grid-cols-2">

            <!-- Left column -->
            <div class="hidden md:flex flex-col justify-center items-center p-12 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                <div class="text-center">
                    <h1 class="font-bold text-3xl mb-2">
                        Manager<span class="font-light">App</span>
                    </h1>
                    <p class="opacity-80">Welcome back! Acess your account to keep going.</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto mt-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>

            <!-- Form column right -->
            <div class="p-8 md:p-12">
                <div class="w-full max-w-md mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Acess your account</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">Enter your data to continue.</p>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <div class="relative">
                                <span class="form-input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                       class="block w-full ps-10 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500" placeholder="name@example.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <div class="relative">
                                <span class="form-input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 0118 8zm-6-4a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                       class="block w-full ps-10 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500" placeholder="••••••••••">
                            </div>
                            @error('password')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember me / Forgot password -->
                        <div class="flex items-center justify-between mb-6">
                            <label for="remember_me" class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ms-2">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium hover:underline" style="color: var(--color-primary);" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>

                        <!-- Login button -->
                        <div class="mb-4">
                            <button type="submit" class="w-full text-white font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105" style="background-color: var(--color-primary);">
                                Login
                            </button>
                        </div>
                    </form>

                    <!-- Link para Registro -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            You don't have an account?
                            <a href="{{ route('register') }}" class="font-semibold hover:underline" style="color: var(--color-primary);">
                                Create one
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
