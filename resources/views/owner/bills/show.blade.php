
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Flat Create') }}
        </h2>
    </x-slot>

  <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-5">
    <h2 class="text-xl">Bill — {{ $bill->month->format('F Y') }}</h2>
    <p>Flat: {{ $bill?->flat?->flat_number }}</p>
    <p>Category: {{ $bill?->category?->name }}</p>
    <p>Amount: {{ $bill?->amount }}</p>
    <p>Carried Due: {{ $bill?->carried_due }}</p>
    <p class="font-semibold">Total Due: {{ $bill?->total_due }}</p>
    <p>Status: {{ ucfirst($bill?->status) }}</p>

    <div class="mt-4">
        <h3 class="font-semibold">Payments</h3>
        <table class="min-w-full">
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Reference</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($bill->payments as $p)
            <tr>
            <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
            <td>{{ $p->amount }}</td>
            <td>{{ $p->reference }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <div class="mt-6">
        <h3 class="font-semibold">Record Payment</h3>
        <form method="POST" action="{{ route('owner.bills.pay', $bill) }}">
        @csrf
        <div class="flex gap-2">
            <input type="number" step="0.01" name="amount" required class="border px-3 py-2" placeholder="Amount">
            <input name="reference" class="border px-3 py-2" placeholder="Reference (optional)">
            <button class="px-3 py-2 bg-green-600 text-white rounded">Pay</button>
        </div>
        </form>
    </div>
</div>
</x-app-layout>
