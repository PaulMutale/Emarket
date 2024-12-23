<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shops;
use Flasher\Laravel\Facade\Flasher;

use Illuminate\Support\Facades\Notification;
use App\Notifications\VerificationRequested;

use Auth;

class AdminShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Get All stores order by id decending for this user
         $shops = Shops::where('owner',"=",Auth::user()->id)->orderBy('id','desc')->get();
         return view('dashboard.shops.index')->with('shops', $shops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'max:255']
          ]);
  
          Shops::create([
           'name' =>  $request->name,
           'phonenumber' => $request->phonenumber,
           'owner' => Auth::user()->id  
          ]);
  
          Flasher::addSuccess('Store Added');  // Flasher
  
          return redirect()->route('shops.index'); // Redirect with success message
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function Verification(Request $request, $id)
    {
        $store = Shops::findOrFail($id);
        $store->verification_status = 'pending';
        $store->verification_code = \Str::random(40); // Generate a random verification code
        $store->save();

        // Notify admin for verification
        // Notification logic goes here

        return response()->json(['message' => 'Verification request sent.'], 200);
    }


    public function verifyStore(Request $request, $storeId)
    {
        $store = Shops::findOrFail($storeId);
        $store->is_verified = true;
        $store->verification_status = 'verified';
        $store->save();

        AdminVerification::create([
            'store_id' => $storeId,
            'admin_id' => $request->user()->id, // assuming admin is authenticated
        ]);

        return response()->json(['message' => 'Store verified successfully.'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get location by id
        $shop = Shops::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->first();
        return view('dashboard.shops.edit')->with('shop', $shop);
    }

    public function verify($id)
    {
        // Get location by id
        $shop = Shops::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->first();
        return view('dashboard.shops.shops_verify')->with('shop', $shop);
    }

    public function requestVerification(Request $request, $id)
    {
        // Get the shop that belongs to the authenticated user
        $shop = Shops::where('owner', Auth::user()->id)->where('id', $id)->first();
    
        if (!$shop) {
            return redirect()->back()->with('error', 'Shop not found or you do not have access.');
        }
    
        // Update the status to 'pending'
        $shop->status = 'pending';
        $shop->save();
    
        // Send notification to admin about the verification request
        // Notification::route('mail', 'admin@example.com')->notify(new VerificationRequested($shop));
    
        // return redirect()->route('shops.verify', $shop->id)->with('success', 'Verification request sent successfully.');
        Flasher::addSuccess('Verification request sent successfully.');
        return redirect()->route('shops.verify', $shop->id); 
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => ['required', 'max:255']
        ]);
        Shops::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->update($request->only('name'));
        

        Flasher::addSuccess('Store Updated');   // Flasher

        return redirect()->route('shops.index');     // Redirect with success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shops::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->delete();
        
        Flasher::addSuccess('Store Removed');    // Flasher

        return redirect()->back();   // Redirect with success message
    }
}
