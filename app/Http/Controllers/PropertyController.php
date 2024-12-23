<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Shops;
use App\Models\Property;
use App\Models\PropertyEnquire;
use App\Mail\EnquireEmail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\ProcessEnquireEmail;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function index(Request $request)
    {
        $latest_properties = Property::latest();
        $locations = Location::select(['id', 'name'])->get();
        $stores = Shops::select(['id', 'name'])->get();



       // Filter by store (using store id)
        if ($request->has('store') && $request->input('store') !== null) {
            $latest_properties->where('store', $request->input('store')); 
        }
        if ($request->has('location') && $request->input('location') !== null) {
            $latest_properties->where('location_id', $request->input('location'));
        }
    
        if ($request->has('country') && $request->input('country') !== null) {
            $latest_properties->where('country_code', strtolower($request->input('country')));
        }
    
        if ($request->has('type') && $request->input('type') !== null) {
            $latest_properties->where('type', $request->input('type'));
        }

        if ($request->has('verified_suppliers') && $request->input('verified_suppliers') !== null) {
            $latest_properties->where('is_verified', $request->input('verified_suppliers'));
        }
    
        if ($request->has('max_price') && is_numeric($request->input('max_price'))) {
            $latest_properties->where('price', '<=', $request->input('max_price'));
        }
    
        if ($request->has('property_name') && $request->input('property_name') !== null) {
            $latest_properties->where('name', 'LIKE', '%' . $request->input('property_name') . '%');
        }
    
        $latest_properties = $latest_properties->paginate(12);
    
        return view('property.index', [
            'latest_properties' => $latest_properties,
            'locations' => $locations,
            'stores' => $stores
        ]);
    }
    
    

//--------------------------- asking ques by user ------------------------------------------------
    public function enquire(Request $request, $propertyID)
    {
        $request->validate([
            'name'  => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:255'],
            'message' => ['required', 'max:255']
        ]);
        $request->message .= 'This message was sent from '. route('property.show',$propertyID) . ' website.';

// Get Owner of the property
$property_inquired = Property::findOrFail($propertyID);
$owner_of_the_property = $property_inquired->owner;

        PropertyEnquire::create([
            'name'  => $request->name,
            'phone'  => $request->phone,
            'email'  => $request->email,
            'message'  => $request->message .'. This message was sent from '. route('property.show',$propertyID) . ' website.',
            'owner' => $owner_of_the_property
        ]);

        // Send User & Admin mail/message
        $data = [$request->all(), 'propertyURL' => route('property.show', $propertyID)];

        // Send User & Admin mail/message via Queue
        ProcessEnquireEmail::dispatch($data);
        // Mail::send(new EnquireEmail($data));     // Send User & Admin mail/message via normal way

        return redirect()->back()->with(['message'=>'Message sent successfully']);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

//--------------------------- Single/individual Property Show(frontend) ------------------------------------------------
    public function show($id)
    {
        $socialShares = \Share::page(
            "https://www.elianamarket.com/",
            'Hi, Check out this property at eliana market!',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        
        

       //$property = Property::with('gallery', 'location')->findOrFail($id);  // Find Property by id

        $property = Property::findOrFail(decrypt($id));
        //dd($property->gallery());
        //dd($property);
        return view('property.single',compact('socialShares'))->with('property', $property);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

}
