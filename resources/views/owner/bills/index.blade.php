<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bill') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl">Bills</h2>
       <div>
         <a href="{{ route('owner.categories.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Bill Category</a>
        <a href="{{ route('owner.bills.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Create Bill</a>
       </div>
      </div>

      <div class="bg-white shadow rounded">
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th>Flat</th>
                    <th>Category</th>
                    <th>Month</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="divide-y text-center">
                @foreach($bills as $bill)
                    <tr>
                        <td class="px-6 py-4">{{ $bill?->flat?->flat_number ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $bill?->category?->name }}</td>
                        <td class="px-6 py-4">{{ $bill?->month?->format('F Y') }}</td>
                        <td class="px-6 py-4">{{ $bill?->total_due }}</td>
                        <td class="px-6 py-4">{{ ucfirst($bill?->status) }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('owner.bills.show', $bill) }}" class="text-blue-600">View</a>
                            <form action="{{ route('owner.bills.pay', $bill) }}" method="POST" class="inline">@csrf
                                <input type="number" name="amount" step="0.01" placeholder="amount" class="w-24 ml-2 px-2 py-1 border rounded">
                                <button class="ml-1 px-2 py-1 bg-green-600 text-white rounded">Pay</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $bills->links() }}</div>
      </div>
    </div>
</x-app-layout>
