<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forgot your password - ManagerAPP</title>

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

            <!-- Branding column left -->
             <div class="hidden md:flex flex-col justify-center items-center p-12 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                <div class="text-center">
                    <h1 class="font-bold text-3xl mb-2">
                        Manager<span class="font-light">APP</span>
                    </h1>
                    <p class="opacity-80">Recover your acess easily.</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto mt-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2v5a2 2 0 01-2 2h-5a2 2 0 01-2-2V9a2 2 0 012-2h5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 11v-1a5 5 0 00-5-5H7a5 5 0 00-5 5v1m12 0v1a5 5 0 00-5 5H7a5 5 0 00-5-5v-1" />
                    </svg>
                </div>
            </div>

            <!-- Form column right -->0
             <div class="p-8 md:p-12">
                <div class="w-full max-w-md mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Forgot your password?</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        No problem. Just let us know your email address and we will email you a password reset link.
                    </p>

                    <!-- Session Status Ex: "Sendind link" -->
                     @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email --><div class="mb-4">
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

                        <!-- Send link button -->
                         <div class="mb-4 mt-6">
                            <button type="submit" class="w-full text-white font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105" style="background-color: var(--color-primary);">
                                Send password reset link
                            </button>
                        </div>
                    </form>

                    <!-- Link to Login -->
                     <div class="text-center mt-6">
                        <a href="{{ route('login') }}" class="text-sm font-semibold hover:underline" style="color: var(--color-primary);">
                            &larr; Come back to login
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>

