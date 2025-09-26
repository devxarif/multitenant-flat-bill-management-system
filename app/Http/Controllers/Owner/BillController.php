<?php

namespace App\Http\Controllers\Owner;

use App\Models\Bill;
use App\Models\Flat;
use App\Models\BillCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public function index(){
        $bills = Bill::with('flat','category','payments')
                        ->where('owner_id',auth()->id())
                        ->orderByDesc('month')
                        ->paginate(20);

        return view('owner.bills.index', compact('bills'));
    }

    public function create(Request $rrequest){
        $flatId = $rrequest->flat_id;
        $categories = BillCategory::where('owner_id', auth()->id())->get();
        return view('owner.bills.create', compact('flatId','categories'));
    }

    public function store(Request $rrequest){
        $rrequest->validate(['flat_id'=>'required|exists:flats,id','bill_category_id'=>'required|exists:bill_categories,id','month'=>'required|date','amount'=>'required|numeric']);
        $month = Carbon::parse($rrequest->month)->startOfMonth()->toDateString();

        // compute carried due
        $prevDue = Bill::where('flat_id',$rrequest->flat_id)
            ->where('month','<',$month)
            ->whereIn('status',['unpaid','partial'])
            ->get()
            ->sum(function($b){
                $paid = $b->payments()->sum('amount');
                return $b->total_due - $paid;
            });

        $flat = Flat::find($rrequest->flat_id);
        $bill = Bill::create([
            'owner_id'=>auth()->id(),
            'building_id'=>$flat->building_id,
            'flat_id'=>$rrequest->flat_id,
            'bill_category_id'=>$rrequest->bill_category_id,
            'month'=>$month,
            'amount'=>$rrequest->amount,
            'carried_due'=>$prevDue,
            'total_due'=>bcadd($rrequest->amount,$prevDue,2),
            'notes'=>$rrequest->notes ?? null,
            'status'=>'unpaid'
        ]);

        // notify Owner + tenants
        auth()->user()->notify(new BillCreatedNotification($bill));
        $tenants = $bill->flat->tenants()->whereNotNull('email')->get();
        foreach($tenants as $t){
            if($t->email) Notification::route('mail', $t->email)->notify(new BillCreatedNotification($bill));
        }

        return redirect()->route('owner.bills.index')->with('success','Bill created');
    }

    public function show(Bill $bill){
        // $this->authorize('manage-owner',$bill);
        $bill->load('payments','flat','category');
        return view('owner.bills.show', compact('bill'));
    }
}
