<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = User::where('role','owner')->with('building')->latest()->paginate(10);
        return view('admin.owners.index', compact('owners'));
    }

    public function create()
    {
        return view('admin.owners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed',
            'building_name'=>'required|string|max:255',
            'building_address'=>'nullable|string|max:500'
        ]);

        $owner = User::create([
            'name'      =>  $data['name'],
            'email'     =>  $data['email'],
            'password'  =>  bcrypt($data['password']),
            'role'      =>  'owner'
        ]);

        $owner->building()->create([
            'name'=>$data['building_name'],
            'address'=>$data['building_address']
        ]);

        return redirect()->route('admin.owners.index')->with('success','Owner created.');
    }

    public function show(User $owner)
    {
        // $this->authorize('isAdmin');
        $owner->load('building.flats.tenants');
        return view('admin.owners.show', compact('owner'));
    }

    public function edit(User $owner)
    {
        return view('admin.owners.edit', compact('owner'));
    }

    public function update(Request $request, User $owner)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$owner->id,
            'password'=>'nullable|string|min:6|confirmed',
            'building_name'=>'required|string|max:255',
            'building_address'=>'nullable|string|max:500'
        ]);

        $owner->update([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=> $data['password'] ? Hash::make($data['password']) : $owner->password
        ]);

        $owner->building()->update([
            'name'=>$data['building_name'],
            'address'=>$data['building_address']
        ]);

        return redirect()->route('admin.owners.index')->with('success','Owner updated.');
    }

    public function destroy(User $owner)
    {
        $owner->delete();
        return back()->with('success','Owner deleted.');
    }
}
