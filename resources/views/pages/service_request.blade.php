<!--Header Section-->
@include('components.header')
<!--Header Section Ends-->



<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header Section -->
	<header class="header-section">
		<a href="#" class="site-logo">
			<h3 style="color: white;">My-<span style="color:red">EMARKET</span></h3>
		</a>
		<nav class="header-nav">
			<ul class="main-menu">
				<li><a href="#" class="active">{{__('Home')}}</a></li>
				<li><a href="{{route('pawn.all')}}">{{__('Promo')}}</a></li>
				
				
				<li><a href="{{route('register')}}">{{__('MyStore')}}</a></li>
				<li>
		
	<form action="{{ route('property.index') }}" method="GET">
    <select name="country" style="color: blue; width: 200px; ">
        <option value="">Filter By Country</option>
        <option value="Zm">Zambia</option>
        @foreach ($countries as $country)
            @php
            $Flag = $countries
                ->where('cca3', $country['cca3'])
                ->first()
                ->flag
                ->flag_icon;
            @endphp
            <option value="{{ $country['cca2'] }}">
                {{ $country['name']['common'] }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary">
        <i class="fa fa-search"></i>
    </button>
</form>

				</li>
				
			</ul>
			<div class="header-right">
				<a href="#" class="hr-btn"><i class="flaticon-029-telephone-1"></i>{{__('Call us now!')}} </a>
				<div class="hr-btn hr-btn-2">{{__('+260 .......')}}</div>
			</div>
		</nav>
	</header>
	<!-- Header Section end -->

	<!-- Hero Section end -->
	<section class="hero-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<form class="hero-form" action="{{route('property.index')}}" method="GET">
					<h3 style="color:white;font-style:italic">{{__('Filter Items For Sale')}}</h3>
					<br>
						
						<div class="flex flex-col mx-1" style="width:100%;">
						<select class="civanoglu-input" name="type" id="type" >
                                    <option value="">Filter By Category</option>
                                    <option value="1">Agricultural Produce</option>
                                    <option value="2">Motor Vehicles</option>
                                    <option value="3">Land & Building</option>
									<option value="4">Computer & Accessories</option>
                                    <option value="5">Mobile Devices</option>
                                    <option value="6">Clothes & Botique</option>
                                    <option value="7">Food Stuffs</option>
                                    <option value="8">Electrical Equipments</option>
                                    <option value="9">Motor Vehicle Spares</option>
                                    <option value="10">Softwares</option>
									<option value="11">Building Materials</option>

                                </select>
        </div>
		<br>
        <div class="flex flex-col mx-1" style="width:100%;">
		<select id="location" name="verified_suppliers" class="border-0 focus:ring-0">
			<option value="">{{ __('Filter By Verified Suppliers') }}</option>
			<option value="1">verified</option>

		</select>

        </div>
		<br>
		<!--Filter by Location Starts Here-->
		<div class="flex flex-col mx-1" style="width:100%;">
		<select id="location" name="store" class="border-0 focus:ring-0">
			<option value="">{{ __('Filter By Store') }}</option>
			@foreach($stores as $store)
				<option class="noTranslate" {{ request('store') == $store->id ? 'selected="selected"' : '' }} value="{{ $store->id }}">{{ $store->name }}</option>
			@endforeach
		</select>

        </div>
		<br>
		<!--Filter by Location Starts Here-->
		<div class="flex flex-col mx-1" style="width:100%;">
            <select id="location" name="location" class="border-0 focus:ring-0">
                <option value="">{{ __('Filter By Location') }}</option>
                @foreach($locations as $location)
                    <option class="noTranslate" {{request('location') == $location->id ? 'selected="selected"' : ''}} value="{{$location->id}}">{{$location->name}}</option>
                @endforeach
            </select>
        </div>
       
		<br>
		<div class="flex flex-col mx-1" style="width:100%;">
		<input type="number" name="max_price" placeholder="{{__('Enter Maximum Price')}}">	
</div>
						<!--Filter By Location Ends Here-->
						<p>{{__('Quickly filter Items!')}}</p>
						<button class="site-btn">{{__('Search')}}</button>
					</form>
				</div>
			</div>
		</div>
		<div class="hero-slider owl-carousel">
			@php 
            $images = \App\Models\Property::where('pawn_id',"!=",0)->get();
			@endphp
			@foreach($images as $featured_image)
			<div class="hs-item set-bg" data-setbg="{{asset('files/'.$featured_image->featured_image)}}"></div>
			@endforeach
			
			
		</div>
	</section>
	<!-- Hero Section end -->
	
	<!-- Why Section end -->
	<section class="why-section spad">
		<div class="container" id="added_items">
			<div class="text-center mb-5 pb-4">
			<h2 style="font-weight:bold">{{ __('Recently added Items') }}</h2>
			<br>
			
        <button class="btn btn-info" style="font-weight:bold"><a href="{{route('register')}}" style="color:white">{{ __('ADD ITEM FOR SALE OR RENT') }}</a></button>
	
			</div>
</div>
				
			
		</div>
	</section>


<!--  Footer Begins -->
@include('components.footer')
<!--Footer Ends-->
	

	
