<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flat;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('flats.building')->latest()->paginate(10);
        return view('admin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        $flats = Flat::with('building')->get();
        return view('admin.tenants.create', compact('flats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email|unique:tenants,email',
            'phone'    => 'nullable|string|max:25',
            'flat_ids' => 'required|array',
            'flat_ids.*' => 'exists:flats,id',
        ]);

        DB::transaction(function () use ($data, &$tenant) {
            $firstFlat = Flat::find($data['flat_ids'][0]);

            $tenantData = [
                'name'        => $data['name'],
                'email'       => $data['email'] ?? null,
                'phone'       => $data['phone'] ?? null,
                'owner_id'    => $firstFlat->owner_id ?? null,
                'building_id' => $firstFlat->building_id ?? null,
            ];

            $tenant = Tenant::create($tenantData);

            $syncData = [];
            $today = now()->toDateString();
            foreach ($data['flat_ids'] as $flatId) {
                $syncData[$flatId] = ['move_in' => $today, 'move_out' => null];
            }

            $tenant->flats()->sync($syncData);
        });

        return redirect()->route('admin.tenants.index')->with('success','Tenant created.');
    }

    public function show(Tenant $tenant)
    {
        $tenant->load('flats.building');
        return view('admin.tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        $flats = Flat::with('building')->get();
        return view('admin.tenants.edit', compact('tenant','flats'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email',
            'phone'    => 'nullable|string|max:25',
            'flat_ids' => 'required|array',
            'flat_ids.*' => 'exists:flats,id',
        ]);

        DB::transaction(function () use ($data, $tenant) {
            $tenant->update([
                'name'  => $data['name'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
            ]);

            $syncData = [];
            $today = now()->toDateString();
            foreach ($data['flat_ids'] as $flatId) {
                $syncData[$flatId] = ['move_in' => $today, 'move_out' => null];
            }

            $tenant->flats()->sync($syncData);
        });

        return redirect()->route('admin.tenants.index')->with('success','Tenant updated.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('admin.tenants.index')->with('success','Tenant deleted.');
    }
}
