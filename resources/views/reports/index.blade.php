<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detailed Reports') }}
            </h2>
        </div>
    </x-slot>

    <style>
        table.custom-table th.align-right,
        table.custom-table td.align-right {
            text-align: right;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filter by year and month --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('reports.index') }}"
                        class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="year" :value="__('Year')" />
                            <select name="year" id="year" onchange="this.form.submit()" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                        focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                                        dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @for ($y = 2020; $y <= date('Y'); $y++)
                                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <x-input-label for="month" :value="__('Month')" />
                            <select name="month" id="month" onchange="this.form.submit()" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                        focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                                        dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Grids Reports --}}
            <div class="grid grid-cols-1 gap-8">

                {{-- Top Expenses by Categories --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4 text-center">Top Expenses by Categories</h3>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 custom-table">
                                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th class="px-4 py-2">Category</th>
                                        <th class="px-4 py-2 align-right">Total</th>
                                        <th class="px-4 py-2 align-right">% of Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($topSpendingCategories as $category)
                                        <tr
                                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                                            <td class="pr-4 px-4 py-2 font-medium text-white dark:text-white">
                                                {{ $category->category_name }}
                                            </td>
                                            <td class="px-4 py-2 align-right">$
                                                {{ number_format($category->total, 2, ',', '.') }}</td>
                                            <td class="px-4 py-2 align-right text-red-500 font-semibold">
                                                {{ $totalExpenses > 0 ? number_format(($category->total / $totalExpenses) * 100, 1, ',', '.') : 0 }}%
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-2 text-white">Any data found on
                                                this period.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Top 5 Biggest Expenses --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4 text-center">Top 5 Expenses</h3>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 custom-table">
                                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th class="px-4 py-2">Description</th>
                                        <th class="px-4 py-2 align-right">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($largestExpenses as $expense)
                                        <tr
                                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                                            <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">
                                                {{ $expense->description }}
                                            </td>
                                            <td class="px-4 py-2 align-right text-red-500">
                                                R$ {{ number_format($expense->amount, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-4 py-2 text-white">Any Expense Found
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
    </div>
</x-app-layout>
