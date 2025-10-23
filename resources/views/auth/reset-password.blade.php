<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ManagerAPP - Redefine Password</title>

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
                    <p class="opacity-80">Create a new password</p>
                    <!-- Key icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto mt-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>
                </div>
            </div>

            <!-- Form column right -->
            <div class="p-8 md:p-12">
                <div class="w-full max-w-md mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-8">Define your new passowrd</h2>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Redefinition token required and hidden -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                                <!-- The email is pre-filled from the link -->
                                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                                       class="block w-full ps-10 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500" placeholder="name@example.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New password -->
                        <div class="mb-4">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">New password</label>
                            <div class="relative">
                                <span class="form-input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                       class="block w-full ps-10 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500" placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm the new password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Confirm the new password</label>
                            <div class="relative">
                                <span class="form-input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                       class="block w-full ps-10 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500" placeholder="••••••••">
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Send button -->
                        <div class="mb-4">
                            <button type="submit" class="w-full text-white font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105" style="background-color: var(--color-primary);">
                                Reset password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

