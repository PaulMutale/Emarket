<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use PragmaRX\Countries\Package\Countries;
use PragmaRX\Countries\Package\Services\Config;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Property;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Models\Media;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Storage;
use Auth;

class PropertyController extends Controller
{

    //------------------------ Index of Property ----------------------------------------------------------------
    public function index()
    {        
        $properties = Property::where('owner', "=", Auth::user()->id)->latest()->paginate(20);
        return view('dashboard.property.index',compact('properties'));
    }

    public function all_properties()
    {
         // Get All stores order by id decending for this user
         $properties = Property::where('owner',"=",Auth::user()->id)->orderBy('id','desc')->get();
         return view('dashboard.allProperties.index')->with('properties', $properties);
    }


    //------------------------ Create Property ----------------------------------------------------------------
    public function create()
    {
        $countries = new Countries(new Config([
            'hydrate' => [
                'elements' => [
                    'currencies' => true,
                    'flag' => true,
                    'timezones' => true,
                ],
            ],
        ]));
        $countries = $countries->all();
        $locations = Location::all(); //Its Fine to pick all Locations
        return view('dashboard.property.create',compact('locations','countries'));
    }



    public function getStates($country)
{
    $countries = new Countries(new Config([
        'hydrate' => [
            'elements' => [
                'currencies' => true,
                'flag' => true,
                'timezones' => true,
                'states' => true,
            ],
        ],
    ]));

    $countryData = $countries->where('cca2', $country)->first();

    if ($countryData) {
        $states = $countryData->states->pluck('name', 'postal')->toArray();

        // Add Copperbelt Province if it's Zambia and it's missing
        if ($country === 'ZM' && !array_key_exists('CB', $states)) {
            $states['CB'] = 'Copperbelt';
        }

        // Debug output
        \Log::info($states);

        $options = '';
        foreach ($states as $code => $name) {
            $options .= "<option value=\"$code\">$name</option>";
        }

        return $options;
    }

    return '';
}


    //------------------------ Save/Store Property ----------------------------------------------------------------
    public function store(Request $request)
    {
     
            // Extended validation for image
            $updated_validation = $this->validateProperty()[] = [
            'featured_image' => 'required|image',
            'gallery_images' => 'required',
        ];

            $request->validate($updated_validation);   // Validation

            // try {
            $property = new Property();    // Property Instance

            $property->location_id = $request->input('location_id');  // Assign location_id


            $this->saveOrUpdateProperty($property, $request);    // Save all data

            Flasher::addSuccess('Property is added');    // Flasher

            return redirect()->route('properties.index');     // Redirect with success message

            // } catch (\Throwable $th) {
        //     return redirect()->route('properties.index')->with(['message' => $th->getMessage()]); // Redirect with error message
            // }
        
    }


    public function show($id)
    {
        //
    }


   // Show edit form
   public function edit($id)
   {
       try {
           // Decrypt the property ID
           $property = Property::where('owner', Auth::user()->id)
                               ->where('id', Crypt::decrypt($id))
                               ->first();

           // Fetch locations
           $locations = Location::where('owner', Auth::user()->id)->get();

           return view('dashboard.property.edit', [
               'property' => $property,
               'locations' => $locations
           ]);
       } catch (\Throwable $th) {
           return redirect()->route('properties.index')->with(['message' => $th->getMessage()]);
       }
   }

   // Update property
   public function update(Request $request, $id)
   {
       try {
           // Find the property by ID
           $property = Property::where('owner', Auth::user()->id)->where('id', $id)->first();
   
           if (!$property) {
               return redirect()->route('properties.index')->with(['message' => 'Property not found.']);
           }
   
           // Validate the request
           $request->validate([
               'name' => 'required|string|max:255',
               'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               'gallery_images' => 'nullable|array',
               'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               'location_id' => 'required|exists:locations,id',
               'price' => 'required|numeric',
               'sale' => 'required|in:1,2',
               'type' => 'required|in:1,2,3,4,5,6,7,8,9,10',
               'why_buy' => 'required|string',
               'description' => 'required|string',
           ]);
   
           // Use the saveOrUpdateProperty method to handle updates
           $this->UpdateProperty($property, $request);

           Flasher::addSuccess('Property updated successfully!.');
           return redirect()->route('properties.index')->with(['message' => 'Property updated successfully!']);
       } catch (\Throwable $th) {
           return redirect()->route('properties.index')->with(['message' => 'An error occurred: ' . $th->getMessage()]);
       }
   }
   
   


    //------------------------ Delete Property ----------------------------------------------------------------
    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        // try {
        $property = Property::where('owner', "=", Auth::user()->id)->where('id', "=", $id)->first();  // Get Property
        
       Storage::delete('public/uploads/' . $property->featured_image);   // delete featured image


        // Check if the property has a gallery and iterate over each media item
    if ($property->gallery !== null) {
        foreach ($property->gallery as $media) {
            $mediaItem = Media::findOrFail($media->id);
            Storage::delete('public/uploads/' . $mediaItem->name);
            $mediaItem->delete();
        }
    }

        $property->delete();    // Delete the property

        Flasher::addSuccess('Property Deleted');  // Flasher

        return redirect()->route('properties.index')->with(['message' => 'Property Deleted']);  // Redirect with success message

        // } catch (\Throwable $th) {
        //     // Redirect with error message
        //     return redirect()->route('properties.index')->with(['message' => $th->getMessage()]);
        // }
    }


    //------------------------ Delete Media ----------------------------------------------------------------
    public function destroyMedia($media_id)
    {
        $media = Media::findOrFail($media_id);   // Get media by id

        Storage::delete('public/uploads/' . $media->name);  // delete the file

        $media->delete();   // Remove from database

        Flasher::addSuccess('Media Deleted');  // Flasher

        return back();  // Back
    }


    //------------------------------ Property form validation ------------------------------------
 protected function validateProperty()
{
    return [
        'name' => 'required|string|max:255',
        'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'location_id' => 'required|integer|exists:locations,id',
        'phonenumber' =>'required|numeric',
        'price' => 'required|numeric',
        'phonenumber'=> 'required|numeric|unique:properties,phonenumber',
        'sale' => 'required|in:1,2',
        'type' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
        'why_buy' => 'required|string',
        'description' => 'required|string',
    ];
}


public function UpdateProperty($property, $request)
{
    // Handle the featured image
    if ($request->hasFile('featured_image')) {
        // Delete the old featured image if it exists
        if ($property->featured_image && file_exists(public_path('files/' . $property->featured_image))) {
            unlink(public_path('files/' . $property->featured_image));
        }

        // Store the new image and update the property
        $property->featured_image = $request->file('featured_image')->store('featured_images');
    }

    // Handle gallery images
    if ($request->hasFile('gallery_images')) {
        // Remove old images related to this property
        Media::where('property_id', $property->id)->delete();

        // Add new images
        foreach ($request->file('gallery_images') as $image) {
            $galleryImageName = $image->store('gallery_images');
            Media::create([
                'property_id' => $property->id,
                'name' => $galleryImageName,
            ]);
        }
    }

    // Update other fields
    $property->name = $request->name;
    $property->phonenumber = $request->phonenumber;
    $property->location_id = $request->location_id;
    $property->price = $request->price;
    $property->sale = $request->sale;
    $property->type = $request->type;
    $property->why_buy = $request->why_buy;
    $property->description = $request->description;
    $property->save();
}


    //-------------------- Save or Update Property ------------------------------------------
    public function saveOrUpdateProperty($property, $request)
    {
        
        // Check if the user has their balance greater than 0 before saving the property details
        // If Balance is equal to 0 denie the application
        
        $property->name = $request->name;
        
        // $property->name_tr = $request->name_tr;

        // Get Default value from database
        $featured_image_name = $property->featured_image;
        // Check if image is empty or not
        if (!empty($request->file('featured_image'))) {
            // Check if the file already exits or not
            if ($featured_image_name) {
                if (file_exists(public_path('files/' . $featured_image_name))) {
                    unlink(public_path('files/' . $featured_image_name));
                }
            }
            // $file = 'uploads/' . $featured_image_name;
            // if (Storage::exists($file)) {
            //     Storage::delete($file);
            // }
            // Get unique name of the image
            $featured_image_name = $request->featured_image->store('gallery_images');
            // Store image in Storage
            $request->featured_image->store('gallery_images');
        }
        // Feature image name into database
        $property->featured_image = $featured_image_name;
        $property->phonenumber =$request->phonenumber;
        $property->location_id = $request->location_id;
        $property->country_state = strtolower($request->country_state);
        $property->country_code = strtolower($request->country_code);
        $property->price = $request->price;
        $property->store = $request->store;
        $property->pawn_id = $request->pawn ?? '';
        $property->type = $request->type;
        // $property->promo_price = $request->newPrice;
       // $property->bedrooms = $request->bedrooms;
        //$property->bathrooms = $request->bathrooms;
        //$property->drawing_rooms = $request->drawing_rooms;
        //$property->net_sqm = $request->net_sqm;
        //$property->gross_sqm = $request->gross_sqm;
        //$property->pool = $request->pool;
        //$property->overview = $request->overview;
        $property->owner = Auth::user()->id;
        //  $property->overview_tr = $request->overview_tr;
        $property->why_buy = $request->why_buy;
        // $property->why_buy_tr = $request->why_buy_tr;
        $property->description = $request->description;
        // $property->description_tr = $request->description_tr;

        // Save or update data
        $property->save();

        //Withdrawal one unit from the wallet
        // Auth::user()->wallet->withdraw(1);



        // Storing Media - Property Gallery
        if (!empty($request->file('gallery_images'))) {
            foreach ($request->gallery_images as $image) {
                $gallery_image_name = $image->store('gallery_images');
                $image->store('gallery_images');
                // Insert into PropertyMedia
                Media::create([
                    'name'  => $gallery_image_name,
                    'property_id'   => $property->id
                ]);
            }
        }
    }

    public function verification(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'status' => 'required|in:pending,verified,rejected',
        ]);

        // Get the shop by id and owner
        $property = Property::find($id);
        if (!$property) {
            Flasher::addSuccess('Shop not found or you do not have access.');

        }

        // Update the status
        $property->status = $validatedData['status'];
        $property->is_verified = $validatedData['status'] === 'verified' ? 1 : 0;

        $property->save();

        // Optionally, send notification to admin about the verification request
        // Notification::route('mail', 'admin@example.com')->notify(new VerificationRequested($shop));

        // Flash a success message
        Flasher::addSuccess('property verification status updated successfully.');

        return redirect()->route('properties.verifyProperty', $property->id); 

    }


    public function verify($id)
    {
        // Get location by id
        $property = property::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->first();
        return view('dashboard.property.property_verify')->with('property', $property);
    }

    public function verifyProperty($id)
    {
        // Get the shop by id and owner
        $property = Property::find($id);
        if (!$property) {
            Flasher::addSuccess('Shop not found or you do not have access.');

        }

        return view('dashboard.allProperties.verifyProperty')->with('property', $property);
    }

    

    

    public function property_verify($id)
    {
        // Get Property by id
        $property = Property::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->first();
        return view('dashboard.allProperties.verify_property')->with('property', $property);
    }

    public function requestVerification(Request $request, $id)
    {
        // Get the shop that belongs to the authenticated user
        $property = Property::where('owner', Auth::user()->id)->where('id', $id)->first();
    
        if (!$property) {
            return redirect()->back()->with('error', 'property not found or you do not have access.');
        }
    
        // Update the status to 'pending'
        $property->status = 'pending';
        $property->save();
    
        // Send notification to admin about the verification request
        // Notification::route('mail', 'admin@example.com')->notify(new VerificationRequested($property));
    
        // return redirect()->route('propertys.verify', $property->id)->with('success', 'Verification request sent successfully.');
        Flasher::addSuccess('Verification request sent successfully.');
        return redirect()->route('properties.verify', $property->id); 
    }    
}
