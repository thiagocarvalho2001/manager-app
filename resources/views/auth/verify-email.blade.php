<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ManagerAPP - Verify your email</title>

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

            <!-- Branding column left -->
            <div class="hidden md:flex flex-col justify-center items-center p-12 text-white" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                <div class="text-center">
                    <h1 class="font-bold text-3xl mb-2">
                        Manager<span class="font-light">APP</span>
                    </h1>
                    <p class="opacity-80">Almost there! We just need to verify your email now.</p>
                    <!-- Email icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto mt-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <!-- Form column right -->
            <div class="p-8 md:p-12">
                <div class="w-full max-w-md mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Confirme seu E-mail</h2>

                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">
                        Thank you for subscribing! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </p>

                    <!-- Msg status resending link -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            A new verification link has been sent to the email address you provided during the registration.
                        </div>
                    @endif

                    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <!-- Resending button -->
                        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full text-white font-bold py-3 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105" style="background-color: var(--color-primary);">
                                Resend email.
                            </button>
                        </form>

                        <!-- Logout button -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full text-center text-sm font-semibold text-gray-600 hover:underline dark:text-gray-400 dark:hover:text-white py-2 px-4">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
