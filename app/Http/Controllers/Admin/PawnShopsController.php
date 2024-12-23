<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PawnShops;
use Flasher\Laravel\Facade\Flasher;
use Auth;

class PawnShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Get All stores order by id decending for this user
         $pawn = PawnShops::where('owner',"=",Auth::user()->id)->orderBy('id','desc')->get();
         return view('dashboard.pawn.index')->with('shops', $pawn);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pawn.create');
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
  
          PawnShops::create([
           'name' =>  $request->name,
           'owner' => Auth::user()->id  
          ]);
  
          Flasher::addSuccess('Pawn Shop Added');  // Flasher
  
          return redirect()->route('pawn.index'); // Redirect with success message
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get location by id
        $pawn = PawnShops::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->first();
        return view('dashboard.pawn.edit')->with('shop', $pawn);
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
        PawnShops::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->update($request->only('name'));
        

        Flasher::addSuccess('Store Updated');   // Flasher

        return redirect()->route('pawn.index');     // Redirect with success message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PawnShops::where('owner',"=",Auth::user()->id)->where('id',"=",$id)->delete();
        
        Flasher::addSuccess('Pawn Shop Removed');    // Flasher

        return redirect()->back();   // Redirect with success message
    }


    public function all(Request $request){
       
        $latest_properties = Property::where('pawn_id',"!=",0)->latest();
        $locations = Location::select(['id', 'name'])->get();
        $latest_properties = $latest_properties->paginate(12);

        return view('property.index', ['latest_properties' => $latest_properties, 'locations' => $locations]);
    }
}
