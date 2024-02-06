<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = [
            'full_name.required' => "Full name is required",
            'username.required'  => "Username is required",
            'email.required'     => "Email is required",
            'password.required'  => "Password is required",
        ];

        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            //'active' => 'boolean',
        ], $messages);

        $validatedData['active'] = isset($request['active']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['email_verified_at'] = date('Y-m-d H:i:s');


        // Create the user
        User::create($validatedData);
       
        // $user = User::create([
        //     'full_name' => $validatedData['full_name'],
        //     'username' => $validatedData['username'],
        //     'email' => $validatedData['email'],
        //     'password' => bcrypt($validatedData['password']), // You may use Hash::make() instead of bcrypt()
        //     'active' => $request->has('active'),

        // ]);

        // Redirect or return response as needed
        return redirect()->route('admin.users')->with('success', 'User added successfully!');
 
    
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); // Retrieve the category by its ID
        
        return view('admin.editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $messages = [
                'full_name.required' => "Full name is required",
                'username.required'  => "Username is required",
                'email.required'     => "Email is required",
                'password.required'  => "Password is required",
            ];
    
            $data = $request->validate([
                'full_name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,'.$id,
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'password' => 'required|string|min:8',
                //'active' => 'boolean',
            ], $messages);

           

            $data['password'] = Hash::make($data['password']);
    
            $data['active'] = isset($request->active);
            
           

            // Update the Car record
            User::where('id', $id)->update($data);

            return redirect()->route('admin.users')->with('success', 'User edited successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error occurred while updating User: ' . $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    



    
}
