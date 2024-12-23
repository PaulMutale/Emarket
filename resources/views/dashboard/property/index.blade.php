<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
                {{ __('Properties') }}
            </h2>
            <a href="{{ route('properties.create') }}"
                class="px-4 py-2 hover:text-white text-white rounded-md text-base bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">Add New Property</a>
        </div>
    </x-slot>

    
<center>
    @if (session('insufficientFunds'))
    <div class="alert alert-danger alert-dismissible fade show w-75" style="margin-top:20px" role="alert">
     <div class="font-medium text-600">
            <i class="fa-regular fa-bell"></i>
        <strong>Hello there!</strong> You have some bad feedbacks
        </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
           
            <div>
            {!! session('insufficientFunds') !!}
    </div>
        
          </div>
        
    @endif
<br>
    <div class="py-12">
        <div class="row">
        <div class="col-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                    <table class="w-full table-auto mb-4">
                        <thead class="bg-green-500 text-white">
                            <tr>
                                <th class="border py-4">Name</th>
                                <th class="border py-4">Location</th>
                                
                                <th class="border py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($properties as $item)
                                <tr class="bg-green-300 text-black hover:bg-red-500 hover:text-white duration-50">
                                    <td class="border py-2">{{ $item->name }}</td>
                                    <td class="border py-2">{{ $item->location->name }}</td>
                                    
                                    <td class="border py-2">
                                    <div class="flex items-center justify-center">
                                            <a href="{{ route('properties.verify', $item->id) }}" class="mx-1 hover:bg-black hover:text-white duration-200 leading-none bg-blue-700 text-white px-3 py-2 text-sm rounded-md">Verify property </a>
                                            <a href="{{ route('properties.edit', encrypt($item->id)) }}" class="mx-1 hover:bg-black hover:text-white duration-200 leading-none bg-blue-700 text-white px-2 py-2 text-sm rounded-md">Edit</a>
                                            <a target="_blank" href="{{ route('property.show',encrypt($item->id)) }}" class="mx-1 hover:bg-black hover:text-white duration-200 leading-none bg-green-700 text-white px-2 py-2 text-sm rounded-md">View</a>

                                            <form action="{{ route('properties.destroy', encrypt($item->id)) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete property?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="mx-1 hover:bg-black hover:text-white duration-200 leading-none bg-red-700 text-white px-2 py-2 text-sm rounded-md">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">No Property Found!</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    </center>
                    <div class="pb-4">
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
