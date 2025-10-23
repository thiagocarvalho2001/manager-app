<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center mt-4">
            <h2 class="text-3xl font-bold text-gray-100">
                 {{ __('Create New Budget') }}
            </h2>
        </div>
    </x-slot>

    <style>
        body {
            background-color: #1a1a1a;
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
        }

        h2 {
            color: #ffffff;
        }

        form {
            background-color: #2a2a2a;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            border: none !important;
        }

        .x-input-label {
            color: #b0b0b0;
        }

        input[type="text"],
        input[type="number"],
        select {
            background-color: #3a3a3a;
            color: #ffffff;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .x-input-error {
            color: #ff4d4d;
            font-size: 0.875rem;
        }

        .bg-slate-950 {
            border: none !important;
            box-shadow: none !important;
        }

        .bg-slate-900 {
            border: none !important;
        }
    </style>

    <div class="flex items-center justify-center bg-slate-950 py-10 px-4 min-h-[calc(100vh-10rem)]">
        <div class="w-full max-w-md bg-slate-900 rounded-2xl shadow-xl p-6 border border-slate-800">

            <form method="POST" action="{{ route('budgets.store') }}" class="space-y-6">
                @csrf

                {{-- Category --}}
                <div>
                    <x-input-label for="category_id" :value="__('Category')" class="text-gray-200 font-medium" />
                    <select name="category_id" id="category_id" class="w-full mt-2 px-4 py-3 bg-slate-800 text-gray-100 border border-slate-700 rounded-xl
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               transition duration-150 ease-in-out appearance-none">
                        <option value="" disabled selected class="text-gray-400 bg-slate-800">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" class="bg-slate-800 text-gray-100">{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2 text-red-400 text-sm" />
                </div>

                {{-- Budget Amount --}}
                <div>
                    <x-input-label for="amount" :value="__('Budget Amount ($)')" class="text-gray-200 font-medium" />
                    <x-text-input id="amount" class="w-full mt-2 px-4 py-3 bg-slate-800 text-gray-100 border border-slate-700 rounded-xl
                               placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               transition duration-150 ease-in-out" type="number" step="0.01" name="amount"
                        :value="old('amount')" required />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2 text-red-400 text-sm" />
                </div>

                {{-- Month and Year --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="month" :value="__('Month')" class="text-gray-200 font-medium" />
                        <select name="month" id="month"
                            class="w-full mt-2 px-4 py-3 bg-slate-800 text-gray-100 border border-slate-700 rounded-xl
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out appearance-none">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ old('month', date('m')) == $m ? 'selected' : '' }}
                                    class="bg-slate-800 text-gray-100">
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('month')" class="mt-2 text-red-400 text-sm" />
                    </div>

                    <div>
                        <x-input-label for="year" :value="__('Year')" class="text-gray-200 font-medium" />
                        <select name="year" id="year"
                            class="w-full mt-2 px-4 py-3 bg-slate-800 text-gray-100 border border-slate-700 rounded-xl
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out appearance-none">
                            @for ($y = date('Y'); $y <= date('Y') + 5; $y++)
                                <option value="{{ $y }}" {{ old('year', date('Y')) == $y ? 'selected' : '' }}
                                    class="bg-slate-800 text-gray-100">
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                        <x-input-error :messages="$errors->get('year')" class="mt-2 text-red-400 text-sm" />
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl
                               shadow-lg shadow-indigo-600/20 transition-transform duration-200 ease-in-out
                               hover:scale-[1.02] focus:ring-4 focus:ring-indigo-400/50">
                        {{ __('Save Budget') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
