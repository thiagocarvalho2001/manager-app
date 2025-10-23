<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ManagerAPP - Confirm your password</title>

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
            padding-left: 0.75rem;
            pointer-events: none;
        }
    </style>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden grid md:grid-cols-2">

            <!-- Branging column left -->
            <div class="hidden md:flex flex-col justify-center items-center p-12 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                <div class="text-center">
                    <h1 class="font-bold text-3xl mb-2">
                        Manage<span class="font-light">APP</span>
                    </h1>
                    <p class="opacity-80">It's a secure area. Confirm your identity.</p>
                    <!-- ICon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto mt-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.662-.503-3.218-1.398-4.524A11.959 11.959 0 0115 2.714" />
                    </svg>
                </div>
            </div>

            <!-- Form column right -->
            <div class="p-8 md:p-12">
                <div class="w-full max-w-md mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Confirmation needed</h2>

                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">
                        This is a secure area of the application. Please confirm your passwrod before continuing.
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- password -->
                        <div class="mb-4">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Your password</label>
                            <div class="relative">
                                <span class="form-input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                       class="block w-full ps-10 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500" placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Send button  -->
                        <div class="mb-4 mt-6">
                            <button type="submit" class="w-full text-white font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105" style="background-color: var(--color-primary);">
                                Confirm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
