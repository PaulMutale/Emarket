<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="px-4 font-semibold text-xl text-gray-800 leading-tight inline-block">
                {{ __('Store Verification') }}
            </h2>
            <a href="{{ route('shops.index') }}" class="px-4 py-2 hover:text-white text-white rounded-md text-base bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">Back</a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 mx-auto w-100">
                <form action="{{ route('stores.storeVerification', $shop->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Shop Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $shop->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="name">Verifaction Status Shop</label>
                        <select class="form-control" id="status" name="status" {{ $shop->status == 'verified' ? 'disabled' : '' }}>
                            <option value="pending" {{ $shop->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ $shop->status == 'verified' ? 'selected' : '' }}>Verified</option>
                            <option value="rejected" {{ $shop->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>                    
                    </div>

                    <button type="submit" class="btn btn-primary">sumbit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
