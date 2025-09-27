<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Flat') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl">Flats</h2>
            <a href="{{ route('owner.flats.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Create Flat</a>
        </div>

        <div class="bg-white shadow rounded">
            <table class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Flat No</th>
                        <th>Owner</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody class="divide-y text-center">
                    @foreach($flats as $flat)
                        <tr>
                            <td class="px-6 py-4">{{ $flat->flat_number }}</td>
                            <td class="px-6 py-4">{{ $flat->flat_owner_name }}</td>
                            <td class="px-6 py-4">{{ $flat->flat_owner_phone }}</td>
                            <td class="px-6 py-4">
                            <td class="px-4 py-3 whitespace-nowrap text-center text-sm">
                                <div class="relative inline-block text-left" x-data="{ open: false }" @keydown.escape="open = false" @click.away="open = false">
                                    <button type="button" @click="open = !open"
                                            class="inline-flex items-center justify-center p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700
                                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <span class="sr-only">Open actions</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>

                                    <div x-show="open" x-cloak x-transition.origin.top.right
                                        class="origin-top-right absolute right-0 mt-2 w-44 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-10">
                                        <div class="py-1">
                                            <a href="{{ route('owner.flats.edit', $flat->id) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Edit
                                            </a>
                                            <a href="{{ route('owner.flats.show', $flat->id) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Details
                                            </a>

                                            <form action="{{ route('owner.flats.destroy', $flat->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this flat? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    Delete
                                                </button>
                                            </form>

                                            <a href="{{ route('owner.bills.create', ['flat_id' => $flat->id]) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Create Bill
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">{{ $flats->links() }}</div>
        </div>
    </div>
</x-app-layout>
