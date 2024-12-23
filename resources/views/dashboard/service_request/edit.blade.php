<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
                {{ __('Edit Properties') }}
            </h2>
            <a href="{{ route('properties.index') }}"
                class="px-4 py-2 hover:text-white text-white rounded-md text-base bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">Back</a>
        </div>
    </x-slot>

    <div class="shadow p-3 mb-5 bg-white rounded">
        <span style="color:red;font-style:italic">Fields marked with an asterisk (*) are mandatory</span>
        <br><br>

        <form action="{{route('properties.update',$property->id)}}" method="post" enctype="multipart/form-data" class="p-6 bg-white border-b border-gray-200">
            @csrf
            @method('PUT')
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="">
                        <label class="civanoglu-label" for="name">Title <span class="required-text">*</span></label>
                        <input class="civanoglu-input" type="text" id="name" name="name" value="{{$property->name}}" required>

                        @error('name')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-6">
                    <label class="civanoglu-label" for="featured_image">Featured Image <span class="required-text">*</span></label>
                    <input class="civanoglu-input" type="file" id="featured_image" name="featured_image">

                    @error('featured_image')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-lg-6">
                    <label class="civanoglu-label" for="gallery_images">Gallery images <span class="required-text">*</span><small class="ml-2 lowercase">(multiple images supported)</small></label>
                    <input class="civanoglu-input" type="file" id="gallery_images" name="gallery_images[]" multiple>

                    @error('gallery_images')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-3">
                <label class="civanoglu-label" for="location_id">Location <span class="required-text">*</span></label>
                <select class="civanoglu-input" name="location_id" id="location_id" required>
                    <option value="">Select location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $property->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                </select>

                @error('location_id')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror

                </div>

                <div class="col-lg-3">
                    <label class="civanoglu-label" for="price">Price <span class="required-text">*</span></label>
                    <input class="civanoglu-input" type="number" id="price" name="price" value="{{$property->price}}" required>

                    @error('price')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-lg-3">
                    <label class="civanoglu-label" for="sale">For <span class="required-text">*</span></label>
                    <select class="civanoglu-input" name="sale" id="sale" required>
                        <option value="">Select type</option>
                        <option {{ $property->sale == '2' ? 'selected="selected"' : '' }} value="2">Rent</option>
                        <option {{ $property->sale == '1' ? 'selected="selected"' : '' }} value="1">Sale</option>
                    </select>

                    @error('sale')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-lg-3">
                    <label class="civanoglu-label" for="type">Type <span class="required-text">*</span></label>
                    <select class="civanoglu-input" name="type" id="type" required>
                    <option value="">Select type</option>
                                    <option value="1">Agriculture Produce</option>
                                    <option value="2">Motor Vehicles</option>
                                    <option value="3">Land & Building</option>
                                    <option value="4">Computer & Accessories</option>
                                    <option value="5">Mobile Devices</option>
                                    <option value="6">Clothes & Botique</option>
                                    <option value="7">Food Stuffs</option>
                                    <option value="8">Electrical Equipments</option>
                                    <option value="9">Motor Vehicle Spares</option>
                                    <option value="10">Softwares</option>
                    </select>

                    @error('type')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-12">
                    <div class="flex-1 px-4">
                        <label class="civanoglu-label" for="why_buy">Why buy <span class="required-text">*</span></label>
                        <textarea class="civanoglu-input" name="why_buy" id="why_buy" cols="30" rows="5" required>{{$property->why_buy}}</textarea>

                        @error('why_buy')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-lg-12">
                    <label class="civanoglu-label" for="description">Description <span class="required-text">*</span></label>
                    <textarea class="civanoglu-input" name="description" id="description" cols="30" rows="10" required>{{ $property->description }}</textarea>

                    @error('description')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <br>

            <button class="btn" type="submit">Update Property</button>
        </form>
    </div>
</x-app-layout>
