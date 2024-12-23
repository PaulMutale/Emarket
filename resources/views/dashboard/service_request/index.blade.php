<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="px-4 py-2 font-semibold text-xl text-gray-800 leading-tight inline-block">
                {{ __('Service Requests') }}
            </h2>
        </div>
    </x-slot>

<div class="container mt-5">    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Service Type</th>
                <th>Attachment</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serviceRequests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->email }}</td>
                    <td>{{ $request->phone }}</td>
                    <td>{{ $request->address }}</td>
                    <td>{{ $request->service_type }}</td>
                    <td>
                        @if ($request->attachment)
                            <a href="{{ asset('storage/' . $request->attachment) }}" target="_blank">Download</a>
                        @else
                            No Attachment
                        @endif
                    </td>
                    <td>{{ $request->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
