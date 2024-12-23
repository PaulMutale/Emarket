@include('components.header')
{{-- Breadcrumb --}}
    <div class="">
        <div class="container mx-auto">
            <div class="row">
            <div class="col-12">
            <ul class="items-center">
                <li><a class="text-3xl text-red-800" href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="mx-3"><i class="fa fa-angle-right"></i></li>
                <li>{{ __('Properties') }}</li>
            </ul>
        </div>
        </div>
        </div>
   
    <!-- Title & Share -->
    <div class="row">
    <div class="bg-white col-12">
        <div class="container mx-auto">
            <h2 class="text-3xl text-gray-600">{{ __('Properties') }}
            
@if(request('type') == 1)  
Agriculture Produce
@elseif(request('type') == 2)
Motor Vehicles
@elseif(request('type') == 3)
Land & Building 
@elseif(request('type') == 4)
Computer & Accessories 
@elseif(request('type') == 5)
Mobile Devices 
@elseif(request('type') == 6)
Clothes & Botique 
@elseif(request('type') == 7)
Food Stuffs 
@elseif(request('type') == 8)
Electrical Equipments 
@elseif(request('type') == 9)
Motor Vehicle Spares 
@elseif(request('type') == 10)
Softwares
@else
@endif
            </h2>


            @if ( !empty(request('location')) || !empty(request('type')) || !empty(request('price')))
                <h3 class="text-sm mt-1 font-normal">

                    Displaying
                   
                    @if(request('type') == 1)  
Agriculture Produce
@elseif(request('type') == 2)
Motor Vehicles
@elseif(request('type') == 3)
Land & Building 
@elseif(request('type') == 4)
Computer & Accessories 
@elseif(request('type') == 5)
Mobile Devices 
@elseif(request('type') == 6)
Clothes & Botique 
@elseif(request('type') == 7)
Food Stuffs 
@elseif(request('type') == 8)
Electrical Equipments 
@elseif(request('type') == 9)
Motor Vehicle Spares 
@elseif(request('type') == 10)
Softwares
@else
@endif

                   

                    @if (request('max_price') <= 1000)
                        within 0 {{ __('ZMW') }} - 1000 {{ __('ZMW') }} Price Range
                    @elseif (request('max_price') <= 10000)
                        within 1000 {{ __('ZMW') }} - 10000 {{ __('ZMW') }} Price Range
                    @elseif (request('max_price') <= 50000)
                        within 10,000 {{ __('ZMW') }} - 50,000 {{ __('ZMW') }} Price Range
                    @elseif (request('max_price') <= 100000)
                        within 50,000 {{ __('ZMW') }} - 100,000 {{ __('ZMW') }} Price Range
                    @elseif (request('max_price') <= 500000)
                        and More than 100,000 {{ __('ZMW') }} Price
                    @endif
                    from
                    {{-- {{ request('location') ?? 'all Location' }} --}}
                    @if(!empty(request('location')))
                        @foreach($locations as $location)
                            @if(request('location') == $location->id)
                                {{$location->name}} location
                            @endif
                        @endforeach
                    @else
                        all Locations
                    @endif
                </h3>
                <h4 class="text-sm font-normal"><span class="font-bold">{{ $latest_properties->total() }}</span> Item Found</h4>
            @endif



        </div>
    </div>
    </div>



    <br>
    <!-- Content Gallarey -->
    <div class="row" >
    @forelse($latest_properties as $property)
            <div class="col-md-4">
                @include('components.single-property-card', ['property' => $property])
            </div>
            @empty
            <center>
                        <div></div>
</center>
            @endforelse
                {{ $latest_properties->links() }}
</div>


<!-- Content Gallarey Ends Here-->



          </div>
        
    
    @include('components.footer')
