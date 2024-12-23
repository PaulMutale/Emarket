<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Flasher\Laravel\Facade\Flasher;
use Auth;

class LocationController extends Controller
{

    public function index()
    {
        // Get All locations order by id decending for this user
        $locations = Location::where('owner',"=",Auth::user()->id)->orderBy('id','desc')->get();
        return view('dashboard.locations.index')->with('locations', $locations);
    }


    public function create()
    {
        return view('dashboard.locations.create');
    }


    public function store(Request $request)
    {
        $request->validate([
          'name'  => ['required', 'max:255']
        ]);

        Location::create([
         'name' =>  $request->name,
         'owner' => Auth::user()->id  
        ]);

        Flasher::addSuccess('Location Added');  // Flasher

        return redirect()->route('location.index'); // Redirect with success message
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        // Get location by id
       $location = Location::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->first();
       return view('dashboard.locations.edit')->with('location', $location);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => ['required', 'max:255']
        ]);
        Location::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->update($request->only('name'));
        

        Flasher::addSuccess('Location Updated');   // Flasher

        return redirect()->route('location.index');     // Redirect with success message
    }


    public function destroy($id)
    {
        Location::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->delete();
        
        Flasher::addSuccess('Location Removed');    // Flasher

        return redirect()->back();   // Redirect with success message
    }
}
