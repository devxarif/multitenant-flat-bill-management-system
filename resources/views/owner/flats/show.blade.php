
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Flat Create') }}
        </h2>
    </x-slot>

  <div class="max-w-5xl mx-auto p-6">
  <div class="bg-white p-4 rounded shadow">
    <h2 class="text-xl font-semibold">Flat: {{ $flat->flat_number }}</h2>
    <p>Owner: {{ $flat->flat_owner_name }} | Phone: {{ $flat->flat_owner_phone }}</p>
    <div class="mt-4">
      <h3 class="font-semibold">Tenants ({{ $flat->tenants->count() }})</h3>
      <ul>@foreach($flat->tenants as $t)<li>{{ $t->name }} — {{ $t->email ?? 'no email' }}</li>@endforeach</ul>
    </div>

    <div class="mt-6">
      <div class="flex justify-between items-center mb-2">
        <h3 class="font-semibold">Bills</h3>
        <a href="{{ route('owner.bills.create', ['flat_id'=>$flat->id]) }}" class="px-3 py-1 bg-blue-600 text-white rounded">Create Bill</a>
      </div>

      <table class="min-w-full divide-y">
        <thead class="bg-gray-50">
            <tr>
                <th>Month</th>
                <th>Category</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
          @foreach($flat->bills as $bill)
            <tr>
                <td class="px-4 py-2">{{ $bill->month->format('F Y') }}</td>
                <td class="px-4 py-2">{{ $bill->category->name }}</td>
                <td class="px-4 py-2">{{ $bill->total_due }}</td>
                <td class="px-4 py-2">{{ ucfirst($bill->status) }}</td>
                <td class="px-4 py-2"><a href="{{ route('owner.bills.show', $bill) }}" class="text-blue-600">View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</x-app-layout>
