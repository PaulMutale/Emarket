<?php

namespace App\Http\Controllers;
use PragmaRX\Countries\Package\Countries;
use PragmaRX\Countries\Package\Services\Config;
use Illuminate\Http\Request;
use App\Models\Shops;
use App\Models\Property;
use App\Models\Location;
use App\Models\Page;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
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

          
       
        
        
        // $latest_properties = Property::all();
        $latest_properties = Property::latest()->simplepaginate(21);
        $locations = Location::select(['id', 'name'])->get();
        $stores = Shops::select(['id', 'name'])->get();


        return view('welcome',[
            'latest_properties' => $latest_properties,
            'locations' => $locations,
            'countries' =>$countries,
            'stores' =>$stores
        ]);
        // return view('welcome')->with(['latest_properties' => $latest_properties]);
        // return view('property.single')->with('property',$property);
        // return view('welcome',compact('latest_properties'));
    }


//--------------------- frotnend(nav) page view ---------------------------------------------
    public function pages($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (!empty($page)) {
            return view('pages.index')->with('page', $page);
        } else {
            return abort('404');
        }
    }


//--------------------- Change Currency ---------------------------------------------
    public function currencyConverter($code)
    {
        Cookie::queue('currency', $code, 3600);
        return back();

        //queue er parameters e 3ta perameter royeche ekahen, 1st er holo amra cookie te amra eta ki 'name' e save korbo, R 2nd parameter holo route theke 'code' ta asbe, R 3rd parameter holo ei cookie ta kotho minute stay korbe(ekhane 3600 minute stay korbe).
    }


    //--------------------- Terms & Conditions ---------------------------------------------
    public function terms()
    {
        return view('components.terms');
        
        
    }

}
