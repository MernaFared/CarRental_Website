<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;

use Illuminate\Http\Request;
use App\Traits\Common;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Common;
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addTestimonials');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $messages = [
                'name.required'        => "Name is required",
                'position.required'  => "Position is required",
                'content.max'       => "Content must be less than 200 char",
                'image.require'         => "Image is required",
                'image.mimes'           => "Image not valid",
                'image.max'             => "Image not valid"
            ];


            // Validate the incoming request data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string',
                'content' => 'required|string',
                 //'published' => 'nullable|boolean',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
               // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image is required and should be an image file
            ], $messages);

            // Handle file upload for the image
            $fileName = $this->uploadFile(file: $request->image, path: 'assets\images\testimonials');
            $data['image'] = $fileName;

            $data['published'] = isset($request['published']);

            Testimonial::create($data);


            // Redirect back with a success message
            return redirect()->route('admin.testimonials')->with('success', 'Testimonial added successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error occurred while storing testimonial: ' . $e->getMessage());

             
            return redirect()->back()->with('error', 'Failed to add testimonial. Please try again later.');
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
        $testimonial = Testimonial::findOrFail($id); // Retrieve the category by its ID
        
        return view('admin.editTestimonials', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $messages = [
                'name.required'        => "Name is required",
                'position.required'  => "Position is required",
                'content.max'       => "Content must be less than 200 char",
                'image' => 'sometimes|mimes:png,jpg,jpeg|max:2048',
            ];


            // Validate the incoming request data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string',
                'content' => 'required|string',
                 //'published' => 'nullable|boolean',
               // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image is required and should be an image file
            ], $messages);
        
            $data['published'] = isset($request->published);
            
            // Update image if new file selected
            if($request->hasFile('image')){
                $fileName = $this->uploadFile($request->image, 'assets/images/testimonials');
                $data['image']= $fileName;
            }

            // Update the Car record
            Testimonial::where('id', $id)->update($data);

            return redirect()->route('admin.testimonials')->with('success', 'Testimonial edited successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error occurred while updating testimonial: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update testimonial. Please try again later.'. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->delete();

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully');
    }
}
