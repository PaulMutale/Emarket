<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Users') }}
            </h2>

            <div class="min-w-max">
                <a href="{{route('user.index')}}" class="px-4 py-2 hover:text-white text-white rounded-md text-base bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">Back</a>
            </div>
        </div>
    </x-slot>
    <div class="shadow p-3 mb-5 bg-white rounded">
        <span style="color:red;font-style:italic">Fields marked with asterisk (*) are mandatory</span>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form action="{{route('user.store')}}" method="post" class="p-6 bg-white border-b border-gray-200" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label class="civanoglu-label" for="name">Name <span class="required-text">*</span></label>
                            <input class="civanoglu-input" type="text" id="name" name="name" value="{{old('name')}}" required>
                            @error('name')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="civanoglu-label" for="email">Email <span class="required-text">*</span></label>
                            <input class="civanoglu-input" type="text" id="email" name="email" value="{{old('email')}}" required>
                            @error('email')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="civanoglu-label" for="password">Password <span class="required-text">*</span></label>
                            <input class="civanoglu-input" type="password" id="password" name="password" required>
                            @error('password')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="civanoglu-label" for="password_confirmation">Password Confirmation <span class="required-text">*</span></label>
                            <input class="civanoglu-input" type="password" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                            @enderror
                        </div>

                        @if(auth()->user()->hasRole(\App\Models\User::SUPER_ADMIN))
                            <div class="mb-6">
                                <label class="civanoglu-label" for="role">Role <span class="required-text">*</span></label>
                                <select class="civanoglu-input" id="role" name="role" required>
                                    <option value="{{ \App\Models\User::SUPER_ADMIN }}" {{ old('role') == \App\Models\User::SUPER_ADMIN ? 'selected' : '' }}>Super Admin</option>
                                    <option value="{{ \App\Models\User::ADMIN }}" {{ old('role') == \App\Models\User::ADMIN ? 'selected' : '' }}>Admin</option>
                                    <option value="{{ \App\Models\User::USER }}" {{ old('role') == \App\Models\User::USER ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        @endif

                        <button class="btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
