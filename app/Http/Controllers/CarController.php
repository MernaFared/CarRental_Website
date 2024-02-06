<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Traits\Common;
use Illuminate\Support\Facades\Log;



class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Common;
       
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
    
       
        return view('admin.addCar', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

           

        
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'luggage' => 'required|integer',
    //         'doors' => 'required|integer',
    //         'passengers' => 'required|integer',
    //         'price' => 'required|numeric',
    //         'active' => 'nullable|boolean',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image is required and should be an image file
    //         'category_id' => 'required|exists:categories,id', // Assuming you have a categories table with an id column
    //     ]);

    //     dd('Store function reached1');


    //     // Handle file upload for the image
    //     $fileName = $this->uploadFile(file: $request->image, path: 'assets\images\cars');
    //     $validatedData['image'] = $fileName;

    //     dd('Store function reached2');

    //     // Create a new car instance and save it to the database
    //     $car = new Car;
    //     $car->title = $validatedData['title'];
    //     $car->description = $validatedData['description'];
    //     $car->luggage = $validatedData['luggage'];
    //     $car->doors = $validatedData['doors'];
    //     $car->passengers = $validatedData['passengers'];
    //     $car->price = $validatedData['price'];
    //     $car->active = isset($validatedData['active']) ? true : false;
    //     $car->image = $validatedData['image'];
    //     $car->category_id = $validatedData['category_id'];
    //     $car->save();

    //     Car::create($car);
    //     dd('Store function reached3');


    //     // Redirect back with a success message
    //     //return redirect()->back()->with('success', 'Car added successfully!');
    //     return response()->json(['message' => 'Car added successfully!']);


   
    // }

    public function store(Request $request)
    {
        try {

            $messages = [
                'title.required'        => "Title is required",
                'description.required'  => "Description is required",
                'description.max'       => "Description must be less than 200 char",
                'image.require'         => "Image is required",
                'image.mimes'           => "Image not valid",
                'image.max'             => "Image not valid",
                'category_id.required'  => "Category is required",
                'luggage.required'        => "luggage is required",
                'doors.required'        => "doors is required",
                'passengers.required'   =>"passengers is required",
                'price.required'        => "price is required",
            ];


            // Validate the incoming request data
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'luggage' => 'required|integer',
                'doors' => 'required|integer',
                'passengers' => 'required|integer',
                'price' => 'required',
                //'active' => 'nullable|boolean',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'category_id' => 'required|exists:categories,id', 
            ], $messages);

            // Handle file upload for the image
            $fileName = $this->uploadFile(file: $request->image, path: 'assets\images\cars');
            $data['image'] = $fileName;

            $data['active'] = isset($request['active']);

            Car::create($data);


            // Redirect back with a success message
            return redirect()->route('admin.cars')->with('success', 'Car added successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error occurred while storing car: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to add car. Please try again later.');
        }
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
        $car = Car::findOrFail($id); // Retrieve the category by its ID
        $categories = Category::select('id', 'name')->get();
        
        return view('admin.editCar', compact('car','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
  

    public function update(Request $request, string $id)
    {
        try {
           

            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string', 
                'luggage' => 'required|integer',
                'doors' => 'required|integer',
                'passengers' => 'required|integer',
                'price' => 'required',
                'image' => 'sometimes',
                'category_id' => 'required|exists:categories,id',
            ]);
            
            if($request->hasFile('image')){
                $fileName = $this->uploadFile(file: $request->image, path: 'assets/images/cars');
                $data['image'] = $fileName;

            }

            $data['active'] = isset($request['active']);

        


            // Update the Car record
            Car::where('id', $id)->update($data);

            return redirect()->route('admin.cars')->with('success', 'Car edited successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error occurred while updating car: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'An error occurred while updating the car. Please try again later.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);

       

        $car->delete();

        return redirect()->route('admin.cars')->with('success', 'Car deleted successfully');
    }
}
