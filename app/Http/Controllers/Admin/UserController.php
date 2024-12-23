<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use MannikJ\Laravel\Wallet\Models\Wallet;
use Flasher\Laravel\Facade\Flasher;
use Auth;
class UserController extends Controller
{

    public function index()
    {
        $users = User::where('owner',"=",Auth::user()->id)->latest()->get();
        return view('dashboard.user.index')->with('users',$users);
    }


    public function create()
    {
        return view('dashboard.user.create');
    }


    public function store(Request $request, Flasher $flasher)
    {
        // Validate the incoming request data
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    
        if (auth()->user()->hasRole(User::SUPER_ADMIN)) {
            $rules['role'] = 'required|string|in:' . implode(',', [User::SUPER_ADMIN, User::ADMIN, User::USER]);
        }
    
        $validatedData = $request->validate($rules);
    
        // Create a new user instance
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->owner = auth()->id(); // Assuming you want to set the owner to the authenticated user
    
        // Assign role if the user is a super admin
        if (auth()->user()->hasRole(User::SUPER_ADMIN)) {
            $user->role = $validatedData['role'];
        } else {
            $user->role = User::USER; // Default role for non-super admin users
        }
    
        // Save the user to the database
        $user->save();
    
        // Create a wallet for the user
        $wallet = new Wallet();
        $wallet->id = $user->id;
        $wallet->save();
    
        // Redirect back to the user index page with a success message
        Flasher::addSuccess('User created successfully.');

    
        return redirect()->route('user.index'); // Redirect with success message
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return view('dashboard.user.edit', ['user' => User::findOrFail($id)]);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        Flasher::addSuccess('User deleted successfully.');    // Flasher

        return redirect()->back();
    }

}
