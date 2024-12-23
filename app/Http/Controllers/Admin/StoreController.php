<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Shops;
use Flasher\Laravel\Facade\Flasher;
use Auth;

class StoreController extends Controller

{
    public function index()
    {
         // Get All stores order by id decending for this user
         $stores = Shops::orderBy('id', 'desc')->get();
         return view('dashboard.allStores.index')->with('stores', $stores);
    }

    public function verifyStore($id)
    {
        // Get the shop by id and owner
        $shop = Shops::find($id);
        if (!$shop) {
            Flasher::addSuccess('Shop not found or you do not have access.');

        }

        return view('dashboard.allStores.verify_store')->with('shop', $shop);
    }

    public function verification(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'status' => 'required|in:pending,verified,rejected',
        ]);

        // Get the shop by id and owner
        $shop = Shops::find($id);
        if (!$shop) {
            Flasher::addSuccess('Shop not found or you do not have access.');

        }

        // Update the status
        $shop->status = $validatedData['status'];
        $shop->is_verified = $validatedData['status'] === 'verified' ? 1 : 0;

        $shop->save();

        // Optionally, send notification to admin about the verification request
        // Notification::route('mail', 'admin@example.com')->notify(new VerificationRequested($shop));

        // Flash a success message
        Flasher::addSuccess('Store verification status updated successfully.');

        return redirect()->route('stores.verifyStore', $shop->id); 

    }
}

