<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="px-4 font-semibold text-xl text-gray-800 leading-tight inline-block">
                {{ __('Add New Stores') }}
            </h2>
            <a href="{{ route('shops.index') }}" class="px-4 py-2 hover:text-white text-white rounded-md text-base bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">Back</a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 mx-auto w-100">
                    <form action="{{ route('shops.store') }}" method="POST">
                        @csrf
                        <div class="flex items-end">
                            <div class="flex-auto">
                                <label for="name" class="civanoglu-label">Store Name<span class="required-text">*</span></label>
                                <input type="text" name="name" class="civanoglu-input h-10" placeholder="Type Store here" value="{{ old('name') }}">
                            </div>
                            
                        </div>
<br>
<button type="submit" class="ml-3 flex-auto rounded-md px-5 py-2 h-10 hover:bg-black hover:text-white duration-200 bg-blue-500 text-white inline-block">Create</button>
                        @error('name')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
