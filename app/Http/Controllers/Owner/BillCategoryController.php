<?php

namespace App\Http\Controllers\Owner;

use App\Models\BillCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillCategoryController extends Controller
{
    public function index(){
        $categories = BillCategory::where('owner_id', auth()->id())->paginate(20);

        return view('owner.categories.index', compact('categories'));
    }

    public function store(Request $request){
        $request->validate(['name'=>'required']);

        BillCategory::create([
            'owner_id'  =>  auth()->id(),
            'name'      =>  $request->name
        ]);

        return back()->with('success','Category created');
    }

    public function destroy(BillCategory $category){
        // $this->authorize('manage-owner', $c);
        $category->delete();

        return back()->with('success','Category removed');
    }
}
