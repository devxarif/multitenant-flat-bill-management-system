<?php

namespace App\Http\Controllers\Owner;

use App\Models\Flat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlatController extends Controller
{
    public function index(){
        $flats = Flat::where('owner_id', auth()->id())->with('tenants')->latest()->paginate(15);

        return view('owner.flats.index', compact('flats'));
    }

    public function create(){
        return view('owner.flats.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'flat_number' => 'required|string|max:50',
            'flat_owner_name' => 'nullable|string|max:255',
            'flat_owner_phone' => 'nullable|string|max:25',
        ]);

        $data['owner_id'] = auth()->id();
        $data['building_id'] = auth()->user()->building->id;

        Flat::create($data);

        return redirect()->route('owner.flats.index')->with('success', 'Flat created.');
    }

    public function show(Flat $flat)
    {
        // $this->authorize('manage-owner', $flat);
        $flat->load(['tenants', 'bills' => function($q){
            $q->with('category')->orderByDesc('month');
        }]);
        return view('owner.flats.show', compact('flat'));
    }

    public function edit(Flat $flat){
        return view('owner.flats.edit', compact('flat'));
    }

    public function update(Request $request, Flat $flat)
    {
        $data = $request->validate([
            'flat_number' => 'required|string|max:50',
            'flat_owner_name' => 'nullable|string|max:255',
            'flat_owner_phone' => 'nullable|string|max:25',
        ]);

        $flat->update($data);

        return redirect()->route('owner.flats.index')->with('success', 'Flat updated.');
    }

    public function destroy(Flat $flat)
    {
        $flat->delete();
        return back()->with('success', 'Flat deleted.');
    }
}
