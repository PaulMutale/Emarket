<x-guest-layout>

    <div class="relative z-10 pt-48 pb-52 bg-cover bg-center" style="background-image:url({{asset('img/pungwa.webp')}})">
        <div class="absolute h-full w-full bg-black opacity-70 top-0 left-0 z-10"></div>
        <div class="container relative z-20 text-white text-center text-2xl">
            <h2 style="font-family:sans-serif" class="font-bold text-5xl mb-8 langBN">{{__('Estate Search - List or Search Estates.')}}</h2>
            <p class="text-2xl mt-8 langBN">{{ __('The most convenient property estate search portal in Zambia, start searching now!') }}</p>
        </div>
    </div>
    </div>
    </div>

    <!-- Search From Area -->
    <div class="-mt-10">
        <div class="container">
            <div class="rounded-lg bg-white p-4 relative z-20 shadow-lg home-search">
                @include('components.property-search-form', ['locations' => $locations])
            </div>
        

    

    
    

    <!-- Last Added Objects -->
    <div class="container py-14">
        <h3 style="font-family:sans-serif" class="section-heading">{{ __('Recently added properties') }}</h3>
        <br>
        <center>
        <button class="btn btn-success" style="font-weight:bold"><a href="{{route('login')}}" style="color:white">{{ __('ADD PROPERTY FOR SALE OR RENT') }}</a></button>
</center>
<br>
        <div class="flex flex-wrap -mx-2 mt-10 row">

            @foreach($latest_properties as $property)
            <div class="col-md-3 col-sm-3 col-xs-12">
                @include('components.single-property-card', ['property' => $property])
            </div>
                @endforeach
                {{ $latest_properties->links() }}

        
    </div>
</div>

</x-guest-layout>






