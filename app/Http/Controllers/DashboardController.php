<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Page;
use App\Models\Property;
use App\Models\PropertyEnquire;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

//----------------------------------- Dashboard Home ---------------------------------------
    public function index()
    {
        $counter = [
            'properties' => Property::where('owner',"=",Auth::user()->id)->count(),
            'location' => Location::where('owner',"=",Auth::user()->id)->count(),
            'page' => count(Page::all()),
            'user' => User::where('owner',"=",Auth::user()->id)->count(),
            'message' => PropertyEnquire::where('owner',"=",Auth::user()->id)->count(),
            'balance'=>Auth::user()->wallet->balance,
        ];

        return view('dashboard.index')->with('counter', $counter);
    }

}
