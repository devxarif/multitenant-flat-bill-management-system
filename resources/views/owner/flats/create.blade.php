
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Flat') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-5">
      <h2 class="text-xl mb-4">Create Flat</h2>
      <form method="POST" action="{{ route('owner.flats.store') }}">
        @csrf
        <div class="mb-3">
          <label class="block text-sm">Flat Number</label>
          <input name="flat_number" required class="w-full border px-3 py-2" value="{{ old('flat_number') }}">
        </div>
        <div class="mb-3">
            <label class="block text-sm">Flat Owner Name</label>
            <input name="flat_owner_name" class="w-full border px-3 py-2" value="{{ old('flat_owner_name') }}">
        </div>
        <div class="mb-3">
            <label class="block text-sm">Flat Owner Phone</label>
            <input name="flat_owner_phone" class="w-full border px-3 py-2" value="{{ old('flat_owner_phone') }}">
        </div>
        <div class="flex justify-end">
            <a href="{{ route('owner.flats.index') }}" class="px-4 py-2 border rounded mr-2">Cancel</a>
            <button class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
        </div>
      </form>
    </div>
</x-app-layout>
