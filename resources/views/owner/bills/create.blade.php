<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Bill') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('owner.bills.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Flat</label>
                        <select name="flat_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Select Flat --</option>
                            @foreach($flats as $flat)
                                <option value="{{ $flat->id }}"
                                    @if($flatId == $flat->id) selected @endif>
                                    {{ $flat->flat_number }} — {{ $flat->building->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Bill Category</label>
                        <select name="bill_category_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Month</label>
                        <input type="month" name="month" value="{{ old('month') }}" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Amount</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Notes</label>
                        <textarea name="notes" rows="3" class="w-full border rounded px-3 py-2">{{ old('notes') }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('owner.bills.index') }}" class="px-4 py-2 border rounded mr-2">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Create Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
