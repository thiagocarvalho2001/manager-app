<x-app-layout>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .card {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .dark .card:hover {
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.05);
        }

        .progress-bar-container {
            background-color: #e5e7eb;
            border-radius: 9999px;
            height: 0.625rem;
            overflow: hidden;
        }

        .dark .progress-bar-container {
            background-color: #4b5563;
        }

        .progress-bar {
            height: 100%;
            border-radius: 9999px;
            transition: width 0.5s ease-in-out;
        }

        .select-custom {
            appearance: none;
            background-color: transparent;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='gray'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1em;
            padding-right: 2.5rem;
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100">
                {{ __('Principal Dashboard') }}
            </h2>
            <a href="{{ route('budgets.index') }}"
               class="text-sm text-indigo-500 hover:text-indigo-400 transition">
                Manage budgets →
            </a>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-10">

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="card p-6 bg-white dark:bg-gray-800 rounded-2xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Revenues of the month</h3>
                        <span class="bg-green-100 dark:bg-green-700/30 text-green-600 dark:text-green-400 px-2 py-1 text-xs rounded-full">+ Revenue</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-3">
                        $ {{ number_format($totalRevenues, 2, ',', '.') }}
                    </p>
                </div>

                <div class="card p-6 bg-white dark:bg-gray-800 rounded-2xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Expenses of the month</h3>
                        <span class="bg-red-100 dark:bg-red-700/30 text-red-600 dark:text-red-400 px-2 py-1 text-xs rounded-full">- Expenses</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-3">
                        $ {{ number_format($totalExpenses, 2, ',', '.') }}
                    </p>
                </div>

                <div class="card p-6 bg-white dark:bg-gray-800 rounded-2xl shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Atual Balance</h3>
                        <span class="bg-blue-100 dark:bg-blue-700/30 text-blue-600 dark:text-blue-400 px-2 py-1 text-xs rounded-full">$</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-3">
                        $ {{ number_format($balance, 2, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- Filters  -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap items-end gap-6">
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year:</label>
                        <select id="year" name="year" onchange="this.form.submit()"
                            class="mt-1 select-custom border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md px-3 py-2">
                            @for ($y = 2020; $y <= date('Y'); $y++)
                                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Month:</label>
                        <select id="month" name="month" onchange="this.form.submit()"
                            class="mt-1 select-custom border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md px-3 py-2">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <!-- Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Expenses by Categories (Atual Month)
                </h3>
                <canvas id="expensesChart" class="w-full h-64"></canvas>
            </div>

            <!-- Budgets  -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Budgets of the Month</h3>
                    <a href="{{ route('budgets.index') }}" class="text-sm text-indigo-500 hover:text-indigo-400 transition">
                        See all →
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($budgets as $budget)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="font-medium dark:text-white">{{ $budget->category_name }}</span>
                                <span class="text-sm dark:text-gray-300">
                                    $ {{ number_format($budget->spent, 2, ',', '.') }} /
                                    <span class="text-gray-400">$ {{ number_format($budget->budgeted, 2, ',', '.') }}</span>
                                </span>
                            </div>
                            <div class="w-full progress-bar-container">
                                @php
                                    $colorClass = 'bg-green-500';
                                    if ($budget->percentage > 100) $colorClass = 'bg-red-600';
                                    elseif ($budget->percentage > 80) $colorClass = 'bg-yellow-400';
                                @endphp
                                <div class="{{ $colorClass }} progress-bar" style="width: {{ min($budget->percentage, 100) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">
                            Any budget defined for this Month.
                            <a href="{{ route('budgets.index') }}" class="text-indigo-400 hover:underline">Create one now!</a>
                        </p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const apiToken = document.querySelector('meta[name="api-token"]').content;
            const response = await fetch(`/api/expenses-by-category?year={{ $selectedYear }}&month={{ $selectedMonth }}`, {
                headers: { 'Authorization': `Bearer ${apiToken}` }
            });
            const data = await response.json();
            const ctx = document.getElementById('expensesChart').getContext('2d');
            if (!data.length) {
                ctx.font = "16px Inter";
                ctx.textAlign = "center";
                ctx.fillText("Nothing to show", 200, 100);
                return;
            }
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.map(i => i.category_name),
                    datasets: [{
                        data: data.map(i => i.total_amount),
                        backgroundColor: [
                            '#34d399', '#60a5fa', '#fbbf24', '#f87171', '#a78bfa', '#f472b6'
                        ],
                        borderWidth: 0,
                    }]
                },
                options: {
                    plugins: {
                        legend: { position: 'bottom', labels: { color: '#9ca3af' } }
                    }
                }
            });
        });
    </script>
</x-app-layout>
