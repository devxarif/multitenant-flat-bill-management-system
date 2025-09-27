<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Details Owner') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-5">
      <h2 class="text-xl font-semibold">{{ $owner->name }} (Owner)</h2>
      <p>Email: {{ $owner->email }}</p>
      <h3 class="mt-4 font-semibold">Building</h3>
      <p>{{ $owner->building->name ?? '-' }} | {{ $owner->building->address ?? '-' }}</p>

      <h3 class="mt-4 font-semibold">Flats</h3>
      <ul>
        @foreach($owner->building->flats ?? [] as $flat)
          <li>{{ $flat->flat_number }} - {{ $flat->flat_owner_name ?? 'No owner' }} (Tenants: {{ $flat->tenants->count() }})</li>
        @endforeach
      </ul>
    </div>
</x-app-layout>
