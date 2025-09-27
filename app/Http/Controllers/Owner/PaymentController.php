<?php

namespace App\Http\Controllers\Owner;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\BillPaidNotification;

class PaymentController extends Controller
{
    public function store(Request $request, Bill $bill)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'reference' => 'nullable|string'
        ]);

        $bill->payments()->create([
            'amount' => $data['amount'],
            'reference' => $data['reference'] ?? null,
        ]);

        $paid = $bill->payments()->sum('amount');
        if ($paid >= $bill->total_due) $bill->status = 'paid';
        elseif ($paid > 0) $bill->status = 'partial';
        else $bill->status = 'unpaid';
        $bill->save();

        $admin = User::where('role','admin')->first();

        if ($admin) $admin->notify(new BillPaidNotification($bill));
        auth()->user()->notify(new BillPaidNotification($bill));

        return back()->with('success','Payment recorded');
    }
}
