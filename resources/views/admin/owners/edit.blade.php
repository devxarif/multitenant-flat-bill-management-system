<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Owner') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-5">
      <h2 class="text-xl mb-4">Edit Owner</h2>
      <form method="POST" action="{{ route('admin.owners.update', $owner) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input name="name" value="{{ old('name',$owner->name??'') }}" class="w-full border px-3 py-2">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input name="email" value="{{ old('email',$owner->email??'') }}" class="w-full border px-3 py-2">
        </div>
        <div class="mb-3">
            <label>Password @if(isset($owner))(leave blank to keep)@endif</label>
            <input type="password" name="password" class="w-full border px-3 py-2">
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border px-3 py-2">
        </div>
        <div class="mb-3">
            <label>Building Name</label>
            <input name="building_name" value="{{ old('building_name', $owner->building->name??'') }}" class="w-full border px-3 py-2">
        </div>
        <div class="mb-3">
            <label>Building Address</label>
            <input name="building_address" value="{{ old('building_address',$owner->building->address??'') }}" class="w-full border px-3 py-2">
        </div>
        <div class="flex justify-end">
            <button class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
        </div>
      </form>
    </div>
</x-app-layout>

