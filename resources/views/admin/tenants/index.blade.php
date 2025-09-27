<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenant') }}
        </h2>
    </x-slot>

    <div class="max-w-8xl mx-auto p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Tenants</h2>
        <a href="{{ route('admin.tenants.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            Create Tenant
        </a>
      </div>

      <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full divide-y">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Phone</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Building</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Flat</th>
              <th class="px-6 py-3 text-center text-sm font-medium text-gray-500">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y">
            @forelse($tenants as $tenant)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->email ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->phone ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($tenant->flats->isEmpty())
                        <span class="text-gray-500">-</span>
                    @else
                        @foreach($tenant->flats as $f)
                            <div class="mb-1">
                                <div class="font-medium text-sm">{{ $f->building->name ?? '—' }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ $f->flat_number }}
                                    @if($f->pivot->move_in)
                                        · moved in: {{ \Illuminate\Support\Carbon::parse($f->pivot->move_in)->toDateString() }}
                                    @endif
                                    @if($f->pivot->move_out)
                                        · moved out: {{ \Illuminate\Support\Carbon::parse($f->pivot->move_out)->toDateString() }}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($tenant->flats->isEmpty())
                        <span class="text-gray-500">-</span>
                    @else
                        @foreach($tenant->flats as $f)
                            <div class="text-sm mb-1">{{ $f->flat_number }}</div>
                        @endforeach
                    @endif
                </td>
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
                                <a href="{{ route('admin.tenants.show', $tenant) }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    View
                                </a>
                                <a href="{{ route('admin.tenants.edit', $tenant) }}"
                                class="block px-4 py-2 text-sm text-indigo-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </a>
                                <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this owner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="px-6 py-6 text-center text-gray-500">No tenants found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <div class="p-4">
          {{ $tenants->links() }}
        </div>
      </div>
    </div>
</x-app-layout>
