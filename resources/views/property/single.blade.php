@include('components.header')
    {{-- Breadcrumb --}}

<!-- Modal -->
<div class="modal fade" id="shopDetailsModal" tabindex="-1" role="dialog" aria-labelledby="shopDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shopDetailsModalLabel">Request Seller's Contact Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Store Name: <span class="font-bold">{{ optional(\App\Models\Shops::find($property->store))->name ?? 'Shop not found' }}
                </span>
                </p>
                @if ($property->is_verified)
                                <span class="ml-2 font-bold">
                                 This suplier is {{ $property->status }}
                                </span>
                                <i class="fa fa-check-circle mr-2 text-blue-500 text-center verification-icon"></i>
                            @else
                                <span class="ml-2 text-red-500 font-bold">
                                Disclaimer: This Supplier is Not Verified:
                                </span>
                                <i class="fa fa-times-circle mr-2 text-red-500 text-center verification-icon"></i>
                            @endif
                            </li>
                                <p>Phone Number: <span class="font-bold">{{$property->phonenumber ?? 'number not added'}}</span></p>
                                @if (optional(\App\Models\Shops::find($property->store))->is_verified)

                                <span class="ml-2 font-bold">
                                    {{ optional(\App\Models\Shops::find($property->store))->status }}
                                </span>
                                <i class="fa fa-check-circle mr-2 text-blue-500 text-center verification-icon"></i>
                            @else
                                <span class="ml-2 text-red-500 font-bold">
                                Disclaimer: This Store is Not Verified:
                                </span>
                                <i class="fa fa-times-circle mr-2 text-red-500 text-center verification-icon"></i>
                            @endif
                            </li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Feature Section -->
<section class="">
		<div class="container">
			<div class="feature-item">
<!--Direction-->
<ul class="flex items-center">
    <div class="row">
        <div class="col-12">
                <li><a class="text-red-800" href="{{ route('property.index') }}">{{ __('Properties') }}</a></li>
                <li class="mx-3"><i class="fa fa-angle-right"></i></li>
                <li>{{$property->name}}</li>
</div>
</div>
</ul>
<!--Direction Ends Here-->


<!--Session Message starts Here--> 
     @if (session('message'))
        <div id="notice" class="text-center bg-red-500 text-white p-3">{{ session('message') }}</div>
    @endif

    <!--Session Message ends Here--> 



<!--Title Starts Here-->
				<div class="row">
					<div class="col-lg-8">
                    @if(request()->is('*bm*'))
                        <h2 class="text-3xl text-gray-600">{{$property->name_tr}}</h2>
                    @else
                        <h2 class="text-3xl text-gray-600">{{ __($property->name) }}</h2>
                    @endif
                    <h3 class="text-lg mt-2">{{ __('Price') }}: <span class="text-red-800">
                        {{-- {{ number_format($property->price, 2, ',', ',') }} ZMW</span> --}}
                        {{-- {{ number_format($property->price) }} {{ __('ZMW') }}</span> --}}
                        ZMW {{ $property->price }}
                    </h3>
					</div>
                    <!--Title Ends Here-->

         <style>
            div#social-links {
                margin: 0 auto;
                max-width: 500px;
            }
            div#social-links ul li {
                display: inline-block;
            }          
            div#social-links ul li a {
                padding: 10px;
                border: 1px solid #ccc;
                margin: 1px;
                font-size: 24px;
                color: #222;
                background-color: #ccc;
            }
        </style>


                    <!--Share Starts Here-->
					<div class="col-lg-4">
						<div class="feature-text">
                       

                        <div class="container mt-4">
            <h2 class="mb-5 text-center">{{__('Share On Social Media')}}</h2>
            {!! $socialShares!!}
        </div>



						</div>
					</div>
				</div>
			</div>

            <!--Share Ends Here-->




			<div class="feature-item">
                <!--Gallarey Starts Here-->
				<div class="row">
					<div class="col-lg-8 order-lg-1">
						

                    <div id="slider" class="">
                    <div class="gallery-slider">
                        @foreach($property->gallery as $gallery)
                            @if (file_exists(public_path('files/'.$gallery->name)))
                            <img src="{{asset('files/'.$gallery->name)}}"/>
                                
                            @else
                            <img src="{{asset('files/'.$gallery->name)}}"/>
                            @endif
                        @endforeach
                    </div>

                    <div class="thumbnail-slider mt-4">
                        @foreach($property->gallery as $gallery)
                            @if (file_exists(public_path('files/'.$gallery->name)))
                            <img src="{{asset('files/'.$gallery->name)}}"/>
                            @else
                            <img src="{{asset('files/'.$gallery->name)}}"/>
                            @endif
                        @endforeach
                    </div>
                </div>


               
                
                
<!--Property Overview Starts Here-->

{{-- Properties --}}
                <div class="bg-white p-8 mt-10 shadow-sm">
                    <h4 class="text-lg langBN">{{ __('Property Features') }}</h4>
                    <div class="border-l-2 border-gray-300 pl-5 ml-5 text-base">
                        <ul>


                            <li class="text-sm mb-2">
                                    <i class="fa fa-home mr-2 text-red-400 text-center"></i>
                                    <span
                                            class="text-sm">{{ __('Type') }}:</span>
                                    <span class="ml-2 font-bold">
                                       {{optional(\App\Models\Shops::find($property->store))->name}}
                                    </span>
                            </li>        
                            <li class="text-sm mb-2">
                            @php
                                $shop = optional(\App\Models\Shops::find($property->store));
                            @endphp

                            @if ($shop && $shop->is_verified)
                                <span class="ml-2 font-bold">
                                    {{ $shop->status }}
                                </span>
                                <i class="fa fa-check-circle mr-2 text-blue-500 text-center verification-icon"></i>
                            @else
                                <span class="ml-2 text-red-500 font-bold">
                                    Not Verified
                                </span>
                                <i class="fa fa-times-circle mr-2 text-red-500 text-center verification-icon"></i>
                            @endif

                            </li>
                                
                               
                            </ul>
                            <!--Bathrooms-->
                            <ul id="bathrooms">
                                <li class="text-sm mb-2">
                                    <i
                                            class="fa fa-shower mr-2 text-red-400 text-center"></i><span
                                            class="text-sm">{{ __('Price') }}:</span>
                                    <span class="ml-2 font-bold">ZMW {{$property->price}}</span>
                                </li>
                                <!--Location-->
                                <li class="text-sm">
                                    <i
                                            class="fa fa-map-marker mr-2 text-red-400 text-center"></i><span
                                            class="text-sm">{{ __('Location') }}:</span>
                                    <span class="ml-2 font-bold noTranslate">{{$property->location->name}}</span>
                                </li>
                            </ul>
                            <!--Location Starts here-->
                           

 <!--Living space starts here-->
 <ul>
                                <li class="text-sm mb-2">
                                    <i
                                            class="fa fa-gratipay mr-2 text-red-400 text-center"></i><span
                                            class="text-sm">{{ __('Category') }}:</span>
                                    <span class="ml-2 font-bold">
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
                                    
                                    </span>
                                </li>
</ul>
                            <!--Living space Ends here-->



                            <!--Pool Starts Here-->

                                    </div>
                                    
                            <!--Pool Starts Here-->

                    </div>
                




<!--Property Overview Ends Here-->      
                             

</div>

                    <!--Gallarey ends here--> 



                    {{-- Sidebar --}}

					<div class="col-lg-4 order-lg-2">
                    
						
<div class="">
	<div class="border-2 border-red-800 px-5 py-3 text-center font-light text-base">
		<p>{{$property->description}}</p>
	</div>
    <!--
	{{-- Form --}}
	<div class="px-4 py-5 text-left bg-gray-300 my-5">
		<h1 class="text-2xl font-normal leading-none mb-5 langBN">{{ __('Enquire about this property') }}</h1>

		<form action="{{ route('enquireform',$property->id) }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="">
				<label class="inputLabel" for="name">{{ __('Name')}} <span class="text-red-800 font-serif">*</span></label>
				<input class="inputField" type="text" id="name" name="name" placeholder="{{__('Name')}}"
				value="{{ old('name') }}">

				@error('name')
					<p class="bg-red-100 text-red-500 px-2 mt-2 text-sm">{{ $message }}</p>
				@enderror
			</div>

			<div class="mt-5">
				<label class="inputLabel" for="phone">{{ __('Phone')}} <span class="text-red-800 font-serif">*</span></label>
				<input class="inputField" type="text" id="phone" name="phone" placeholder="{{ __('Phone')}}"
				value="{{ old('phone') }}">

				@error('phone')
					<p class="bg-red-100 text-red-500 px-2 mt-2 text-sm">{{ $message }}</p>
				@enderror
			</div>

			<div class="mt-5">
				<label class="inputLabel" for="email">{{ __('Email')}} <span class="text-red-800 font-serif">*</span></label>
				<input class="inputField" type="email" id="email" name="email" placeholder="{{ __('Email')}}"
				value="{{ old('email') }}">

				@error('email')
					<p class="bg-red-100 text-red-500 px-2 mt-2 text-sm">{{ $message }}</p>
				@enderror
			</div>

			<div class="mt-5">
				<label class="inputLabel" for="message">{{ __('Message')}} <span class="text-red-800 font-serif">*</span></label>
				<textarea class="inputField" id="message" name="message" rows="4" placeholder="{{__('I am interested in this property')}}"></textarea>

				@error('message')
					<p class="bg-red-100 text-red-500 px-2 mt-2 text-sm">{{ $message }}</p>
				@enderror
			</div>
        -->
			<div class="mt-5">
            <button type="button" class="w-full border-2 uppercase text-center py-3 font-semibold border-red-800 hover:bg-transparent hover:text-red-800 duration-200  text-white bg-red-800 rounded-none" data-toggle="modal" data-target="#shopDetailsModal">
               <i class="fa fa-commenting mr-2"></i> Request Seller's Contact Details
            </button>
				<!-- <button type="submit" class="w-full border-2 uppercase text-center py-3 font-semibold border-red-800 hover:bg-transparent hover:text-red-800 duration-200  text-white bg-red-800 rounded-none"><i class="fa fa-commenting mr-2"></i><a href="{{route('payments.payments')}}">Request Sellers Contact Details</a></button> -->
			</div>

		</form>
	</div>
</div>


</div>

</div>
					</div>
				</div>







<!--Why Buy This Property--> 
{{-- Overview --}}
	<div class="flex justify-between items-center bg-white p-8 mt-10 shadow-sm">
		<h4 class="text-lg w-2/12">{{ __('Why buy this Property') }}</h4>
		<div class="border-l-2 border-gray-300 pl-5 ml-5 w-10/12 text-base">
			@if(request()->is('*bm*'))
				<p>{{$property->why_buy_tr}}</p>
			@else
				<p>{{$property->why_buy}}</p>
			@endif
		</div>
	</div>

	{{-- Description --}}
	<div class="bg-white p-8 mt-10 shadow-sm" id="description">
		<h2 class="font-bold mb-5 text-2xl"> PROPERTY DESCRIPTION</h2>
			@if(request()->is('*bm*'))
				<p>{{$property->description_tr}}</p>
			@else
				<p>{{$property->description}}</p>
			@endif
	</div>



<!--End Why Buy This Property-->






			</div>
		</div>
	</section>
	<!-- Feature Section end -->







    
   

    

                
          


   


    
    
@include('components.footer')
