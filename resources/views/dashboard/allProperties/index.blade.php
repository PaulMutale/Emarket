<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="px-4 py-2 font-semibold text-xl text-gray-800 leading-tight inline-block">
                {{ __('Stores') }}
            </h2>
            <a href="{{ route('shops.create') }}" class="py-2 hover:text-white text-white rounded-md text-base bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">Add New Store</a>
        </div>
    </x-slot>
    @if (session('message'))
        <div id="notice" class="text-center bg-red-500 text-white p-3">{{ session('message') }}</div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                    <table class="w-full table-auto mb-4">
                        <thead class="bg-green-500 text-white">
                            <tr>
                                <th class="border py-3 text-center">No</th>
                                <th class="border py-3 text-center">Store-ID</th>
                                <th class="border py-3">Name</th>
                                <th class="border py-3">Status</th>
                                <th class="border py-3 w-44">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($properties as $shop)
                                <tr class="bg-green-300 hover:bg-red-500 hover:text-white duration-50">
                                    <td class="border py-2 text-center">{{$loop->iteration}}</td>
                                    <td class="border py-2 text-center">{{$loop->iteration}}{{date('Y')}}{{auth()->user()->id}}</td>
                                    <td class="border py-2">{{ $shop->name }}</td>
                                    <td class="border py-2">{{ $shop->status }}</td>
                                    <td class="border py-2">
                                        <div class="flex items-center justify-center">
                                           <a href="{{ route('properties.verifyProperty', $shop->id) }}" class="mx-1 hover:bg-black hover:text-white duration-200 leading-none bg-blue-700 text-white px-3 py-2 text-sm rounded-md">Verify</a>

                                            <form action="{{ route('shops.destroy', $shop->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the store?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="mx-1 hover:bg-black hover:text-white duration-200 leading-none bg-red-700 text-white px-3 py-2 text-sm rounded-md">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="3">No Store Found!</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
