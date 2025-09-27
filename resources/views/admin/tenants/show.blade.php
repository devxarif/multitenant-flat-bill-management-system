<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenant Details') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $tenant->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">Email: {{ $tenant->email ?? '-' }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Phone: {{ $tenant->phone ?? '-' }}</p>
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('admin.tenants.edit', $tenant) }}" class="px-3 py-1 bg-indigo-600 text-white rounded">Edit</a>
                        <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST" class="inline" onsubmit="return confirm('Delete this tenant?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="mt-6">
                    <h4 class="font-semibold mb-2">Assigned Flats</h4>
                    @if($tenant->flats->isEmpty())
                        <p class="text-gray-500">No flats assigned.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($tenant->flats as $flat)
                                <div class="p-4 border rounded bg-gray-50 dark:bg-gray-700">
                                    <p><strong>Building:</strong> {{ $flat->building?->name ?? '-' }}</p>
                                    <p><strong>Flat:</strong> {{ $flat->flat_number ?? '-' }}</p>
                                    @if($flat->pivot->move_in)
                                        <p class="text-sm text-gray-500">Move in: {{ \Illuminate\Support\Carbon::parse($flat->pivot->move_in)->toDateString() }}</p>
                                    @endif
                                    @if($flat->pivot->move_out)
                                        <p class="text-sm text-gray-500">Move out: {{ \Illuminate\Support\Carbon::parse($flat->pivot->move_out)->toDateString() }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
