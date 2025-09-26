<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Owner Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Owner Dashboard</h1>
  <div class="grid grid-cols-2 gap-4">
     <a href="{{ route('owner.flats.index') }}" class="p-4 bg-white rounded shadow">Flats</a>
    <a href="{{ route('owner.bills.index') }}" class="p-4 bg-white rounded shadow">Bills</a>
  </div>
</div>
</x-app-layout>
