<div class="px-2 relative rounded-md mb-6">
    <div class="shadow-lg">
        <a href="" class="absolute left-3 w-9 h-9 leading-10 self-center text-base top-3 bg-black text-white bg-opacity-25 text-center hover:bg-yellow-500 hover:text-white duration-200 rounded-full"><i class="fa fa-heart-o"></i></a>

        {{-- @if ( File::exists(public_path('files/') . $property->featured_image) ) --}}
        @if (file_exists(public_path('files/' . $property->featured_image)))
        <img src="{{asset('files/'.$property->featured_image)}}" style="width:100%; height:200px"/>
       
        @else
        <img src="{{asset('files/'.$property->featured_image)}}" style="width:100%; height:200px"/>
        @endif
        <style>
    .verified-icon {
      color: #1DA1F2; /* Set the color to blue */
    }
    .unverified-icon {
      color: #808080; /* Set the color to gray */
    }
  </style>
        <div class="p-3">
            <!--For Bemba-->
            @if(request()->is('*bm*') && $property->sale==1)
                <h2 class="leading-0 text-base">{{ __('They are selling') }}</h2>
                @elseif(request()->is('*bm*') && $property->sale==2)
                <h2 class="leading-0 text-base">{{ __('They are renting') }}</h2>
                <!--For Bemba Ends Here-->

                <!--For French starts Here-->
                @elseif(request()->is('*fr*') && $property->sale==1)
                <h2 class="leading-0 text-base">{{ __('They are selling') }}</h2>
                @elseif(request()->is('*fr*') && $property->sale==2)
                <h2 class="leading-0 text-base">{{ __('They are renting') }}</h2>
                <!--For French Ends Here-->
            @else
                <h2 class="leading-0 text-base">{{ __($property->name) }} <span> <i class="fas fa-check-circle unverified-icon"></i></span> </h2>
            @endif
            
            
            {{-- <h3 class="text-2xl py-3">{{ ($property->price) }} {{ __('ZMW') }}</h3> --}}
           
            <h3 class="text-2xl py-3">{{ __('ZMW') }}  @if($property->promo_price > 0) <del>{{ ($property->promo_price) }}</del> @endif  {{ ($property->price)  }} </h3>
            <div class="border-t-2">
                <ul class="flex items-center -mx-1 my-4">
                    <li class="px-2 py-1 bg-gray-200 rounded-md text-xs mx-1 shadow-sm">{{ optional(\App\Models\Shops::find($property->store))->name ?? 'Shop not found' }}
                    </li>
                    <li class="px-2 py-1 bg-gray-200 rounded-md text-xs mx-1 shadow-sm">
@if($property->type == 1)  
Agriculture Produce
@elseif($property->type == 2)
Motor Vehicles
@elseif($property->type == 3)
Land & Building 
@elseif($property->type == 4)
Computer & Accessories 
@elseif($property->type == 5)
Mobile Devices 
@elseif($property->type == 6)
Clothes & Botique 
@elseif($property->type == 7)
Food Stuffs 
@elseif($property->type == 8)
Electrical Equipments 
@elseif($property->type == 9)
Motor Vehicle Spares 
@elseif($property->type == 10)
Softwares
@else
@endif

                    </li>
                    <li class="px-2 py-1 bg-gray-200 rounded-md text-xs mx-1 shadow-sm">{{App\Models\Location::find($property->location_id)->name}}</li>
                </ul>
                <a href="{{route('property.show', encrypt($property->id))}}" class="btn w-full text-center">{{ __('More details') }}</a>
            </div>
        </div>
    </div>
</div>
