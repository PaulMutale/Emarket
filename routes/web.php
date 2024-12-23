<?php

// Backend
use App\Http\Controllers\Admin\LocationController as AdminLocationController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminShopsController;
use App\Http\Controllers\Admin\PawnShopsController;
use App\Http\Controllers\Admin\StoreController;

// Frontend
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\SocialShareController;
use App\Http\Controllers\ServiceRequestController;


// Recharge Units Payments
use App\Http\Controllers\FlutterwaveWebhookResponse;

Route::get('/get-states/{country}', [AdminPropertyController::class, 'getStates'])->name('get-states');


Route::group(['prefix'=>'payments'], function () {
    // payments
    Route::get('/payments', [App\Http\Controllers\Payments\Payments::class,'payments'])->name('payments.payments');
   
   // visa
   Route::get('/visa', [App\Http\Controllers\Payments\Payments::class,'visa'])->name('payments.visa');
   
   // mtn
   Route::get('/mtn', [App\Http\Controllers\Payments\Payments::class,'mtn'])->name('payments.mtn');
   
   
   // airtel
   Route::get('/airtel', [App\Http\Controllers\Payments\Payments::class,'airtel'])->name('payments.airtel');
   
   // zamtel
   Route::get('/zamtel', [App\Http\Controllers\Payments\Payments::class,'zamtel'])->name('payments.zamtel');
       
   
   });


 Route::get('pawn-all', [PawnShopsController::class,'all'])
     ->name('pawn.all');


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Property
    Route::resource('property', PropertyController::class);

    // Property Enquire
    Route::post('/property/enquire/{id}', [PropertyController::class, 'enquire'])->name('enquireform');
    // Page
    Route::get('/page/{slug}', [HomeController::class, 'pages'])->name('page');
    // Currency Change
    Route::get('/currency-change/{code}', [HomeController::class, 'currencyConverter'])->name('currency');
    // Terms and Conditions
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
});


    Route::prefix('dashboard')->middleware('auth')->group(function () {
    // Dashboard/Admin Panel
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    // Property
    Route::resource('properties',  AdminPropertyController::class);

    Route::middleware(['auth'])->group(function () {
        Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
    });
    
    Route::resource('allProperties',AdminPropertyController::class);
    Route::get('/allProperties', [AdminPropertyController::class, 'all_properties'])->name('allProperties.all_properties');


    // Delete Media
    Route::get('properties/delete-media/{id}', [AdminPropertyController::class, 'destroyMedia'])->name('deleteMedia');

    Route::get('/properties/{id}/verify', [AdminPropertyController::class, 'verify'])->name('properties.verify');
    Route::post('/properties/{id}/request_verification', [AdminPropertyController::class, 'requestVerification'])->name('properties.request_verification');
    Route::get('/properties/{id}/verifyProperty', [AdminPropertyController::class, 'verifyProperty'])->name('properties.verifyProperty');
    Route::get('/properties/{id}/verify_Property', [AdminPropertyController::class, 'verify_Property'])->name('properties.verify_Property');
    Route::post('/properties/propertyVerification/{id}', [AdminPropertyController::class, 'verification'])->name('properties.propertyVerification');
    

    
    // Location
    Route::resource('location', AdminLocationController::class);
    // Stores
    Route::resource('shops', AdminShopsController::class);
    Route::get('/shops/{id}/verify', [AdminShopsController::class, 'verify'])->name('shops.verify');
    Route::post('/shops/{id}/request_verification', [AdminShopsController::class, 'requestVerification'])->name('shops.request_verification');

    Route::resource('allStores', StoreController::class);
    Route::group(['middleware' => ['auth', 'role:' . \App\Models\User::SUPER_ADMIN]], function () {
        Route::get('/service-request', [ServiceRequestController::class, 'index'])->name('service_request.index');
        Route::get('/stores', [StoreController::class, 'index'])->name('allStores.index');
        Route::get('/stores/{id}/verifyStore', [StoreController::class, 'verifyStore'])->name('stores.verifyStore');
        Route::post('/stores/storeVerification/{id}', [StoreController::class, 'verification'])->name('stores.storeVerification');
    });


    // Add this route in routes/web.php

    Route::resource('service_request', ServiceRequestController::class);


     // Pawn Shops
    Route::resource('pawn', PawnShopsController::class);
    
    // Page
    Route::resource('pages', AdminPageController::class);
    // User
    Route::resource('user', UserController::class);
    // Message
    Route::resource('message', AdminMessageController::class);


    
    

});



Route::group(['prefix' => 'payments'],function () {
    // FluttwerWave WebHook Url 
    Route::get('/units', [FlutterwaveWebhookResponse::class,'flutterwave_callback_response'])->name('units');
   
   
});


require __DIR__.'/auth.php';






// Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
//   // Home
//   Route::get('/', [HomeController::class, 'home'])->name('home');
//   // Property
//   Route::get('/property/{id}', [PropertyController::class, 'singleProperty'])->name('single-property');
//   Route::post('/property/enquire/{id}', [PropertyEnquireController::class,'enquire'])->name('enquireform');
//   Route::get('/properties', [PropertyController::class, 'index'])->name('properties');
//   // Page
//   Route::get('/page/{slug}', [PageController::class, 'single'])->name('page');
// });


// Route::prefix('dashboard')->middleware('auth')->group(function () {
//   Route::get('/', [DashboardController::class,'index'])->name('dashboard');
//   Route::get('properties', [DashboardController::class,'properties'])->name('adminProperties');
//   Route::get('properties/addnew', [DashboardController::class,'createProperty'])->name('createProperty');
//   Route::get('properties/edit/{id}', [DashboardController::class, 'editProperty'])->name('editProperty');
//   Route::put('properties/update/{id}', [DashboardController::class, 'updateProperty'])->name('updateProperty');
//   Route::delete('properties/destroy/{id}', [DashboardController::class, 'destroyProperty'])->name('destroyProperty');
//   Route::post('properties/store', [DashboardController::class, 'storeProperty'])->name('storeProperty');

//   Route::get('properties/delete-media/{id}', [DashboardController::class, 'deleteMedia'])->name('deleteMedia');

//   // Locations
//   Route::get('locations', [LocationController::class, 'index'])->name('adminLocations');
//   Route::get('locations/create', [LocationController::class, 'create'])->name('createLocation');
//   Route::post('locations/create/new', [LocationController::class, 'store'])->name('storeLocation');
//   Route::get('location/edit/{id}', [LocationController::class, 'edit'])->name('editLocation');
//   Route::put('location/update/{id}', [LocationController::class, 'update'])->name('updateLocation');
//   Route::delete('location/delete/{id}', [LocationController::class, 'destroy'])->name('deleteLocation');
// });
