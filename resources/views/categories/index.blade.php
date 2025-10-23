<x-app-layout>
    @section('title', 'Transactions')
    <x-slot name="header">
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Categories') }}
            </h2>
        </div>
    </x-slot>
    <style>
        /*  Align the table    */
        table.custom-table th.align-right {
            text-align: right;
        }

        /* Button red */
        .btn-delete-color {
            color: #e53e3e;
            /* Cor vermelha para modo claro (text-red-600) */
        }

        .dark .btn-delete-color {
            color: #f56565;
            /* Cor vermelha para modo escuro (text-red-500) */
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200 dark:text-gray-100">

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('categories.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            New Category
                        </a>
                    </div>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-300 dark:text-gray-400 custom-table">
                            <thead
                                class="text-xs text-gray-200 uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3 align-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr class="bg-gray-800 border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-200 whitespace-nowrap dark:text-white">
                                            {{ $category->name }}
                                        </th>
                                        <td class="px-6 py-4 flex justify-end gap-4">
                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="font-medium text-blue-400 dark:text-blue-500 hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium hover:underline btn-delete-color"
                                                    onclick="return confirm('Do you want to delete this category?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-4 text-center text-gray-300">Any category found.</td>
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
