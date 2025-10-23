<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Budgets') }}
            </h2>
        </div>
    </x-slot>
    <style>
        /*  Align the table    */
        table.custom-table th.align-center,
        table.custom-table td.align-center {
            text-align: center;
        }

        table.custom-table th.align-right,
        table.custom-table td.align-right {
            text-align: right;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- New Budget button --}}
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('budgets.index') }}" class="flex items-center gap-2">
                            <select name="month"
                                class="border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200">
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="year"
                                class="border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200">
                                @foreach (range(now()->year - 2, now()->year + 1) as $y)
                                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition">
                                Filter
                            </button>
                        </form>

                        <a href="{{ route('budgets.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md
                            font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700
                            active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300
                            disabled:opacity-25 transition ease-in-out duration-150">
                            New Budget
                        </a>
                    </div>

                    {{-- Budget Tables --}}
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 custom-table">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Categories</th>
                                    <th scope="col" class="px-6 py-3 align-right">Budget Values</th>
                                    <th scope="col" class="px-6 py-3 align-right">Expenses</th>
                                    <th scope="col" class="px-6 py-3 align-center">Used</th>
                                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($budgetDetails as $budget)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-white dark:text-white">
                                            {{ $budget->category_name }}
                                        </td>
                                        <td class="px-6 py-4 align-right"> $
                                            {{ number_format($budget->budgeted, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 align-right"> $
                                            {{ number_format($budget->spent, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 align-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-2.5 rounded-full"
                                                    style="width: {{ min($budget->percentage, 100) }}%">
                                                </div>
                                            </div>
                                            <span class="text-xs">{{ $budget->percentage }}%</span>
                                        </td>
                                        <td class="px-6 py-4 flex justify-end gap-4"> <a
                                                href="{{ route('budgets.edit', $budget->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('budgets.destroy', $budget->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this budgter?')"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center">
                                            Any budget found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
