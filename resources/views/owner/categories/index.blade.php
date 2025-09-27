<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bill Categories') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-5">
      <h2 class="text-xl mb-4">Bill Categories</h2>

      <form class="mb-4" method="POST" action="{{ route('owner.categories.store') }}">
        @csrf
        <div class="flex gap-2">
          <input name="name" class="flex-1 border px-3 py-2" placeholder="">
          <button class="px-4 py-2 bg-green-600 text-white rounded">Add</button>
        </div>
      </form>

      <ul>
        @foreach($categories as $c)
          <li class="flex justify-between items-center py-2">
            <span>{{ $c->name }}</span>
            <form method="POST" action="{{ route('owner.categories.destroy', $c) }}" onsubmit="return confirm('Delete category?');">
              @csrf
              @method('DELETE')
              <button class="text-red-600">Delete</button>
            </form>
          </li>
        @endforeach
      </ul>
      <div class="mt-4">{{ $categories->links() }}</div>
    </div>
</x-app-layout>
