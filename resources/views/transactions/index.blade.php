<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Transactions') }}
            </h2>
        </div>
    </x-slot>>

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

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('transactions.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            New Transaction
                        </a>
                    </div>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 custom-table">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Description</th>
                                    <th scope="col" class="px-6 py-3 align-right">Values</th>
                                    <th scope="col" class="px-6 py-3 align-center">Categories</th>
                                    <th scope="col" class="px-6 py-3 align-center">Dates</th>
                                    <th scope="col" class="px-6 py-3 align-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                                            {{ $transaction->description }}
                                        </th>
                                        <td
                                            class="px-6 py-4 align-right {{ $transaction->type === 'revenue' ? 'text-green-500' : 'text-red-500' }}">
                                            $ {{ number_format($transaction->amount, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 align-center">
                                            {{ $transaction->category->name ?? 'No Category' }}
                                        </td>
                                        <td class="px-6 py-4 align-center">
                                            {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 flex justify-end gap-4">
                                            <a href="{{ route('transactions.edit', $transaction) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('transactions.destroy', $transaction) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center">Any transaction found.</td>
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
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <form method="GET" action="{{ route('transactions.index') }}" class="flex items-center space-x-4">
                <div>
                    <label for="year" class="block text-sm font-medium">Year:</label>
                    <select name="year" id="year" onchange="this.form.submit()"
                        class="bg-gray-700 border border-gray-600 rounded-md py-2 px-3">
                        @for ($y = 2020; $y <= date('Y'); $y++)
                            <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="month" class="block text-sm font-medium">Mês:</label>
                    <select name="month" id="month" onchange="this.form.submit()"
                        class="bg-gray-700 border border-gray-600 rounded-md py-2 px-3">
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>
