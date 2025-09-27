<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Tenant') }}
        </h2>
    </x-slot>

    <div class="py-8 mt-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.tenants.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2">
                        @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2">
                        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2">
                        @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Assign to Flats</label>
                        <select name="flat_ids[]" multiple class="w-full border rounded px-3 py-2 h-40" required>
                            @foreach($flats as $flat)
                                <option value="{{ $flat->id }}" {{ in_array($flat->id, old('flat_ids', [])) ? 'selected' : '' }}>
                                    {{ $flat->flat_number }} — {{ optional($flat->building)->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Hold Ctrl / Cmd (or use multi-select UI) to select multiple flats.</p>
                        @error('flat_ids') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.tenants.index') }}" class="px-4 py-2 border rounded mr-2">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
