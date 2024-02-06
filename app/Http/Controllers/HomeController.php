<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Car;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
         * Create a new controller instance.
         *
         * @return void
         */
        
         /*
        public function __construct()
        {
            $this->middleware('auth');
        } 
        */
    
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
    public function index()
    {
        $latestCars = Car::where('active', true)->latest()->take(6)->get();
    
            // last 3 active testimonials
            $latestTestimonials = Testimonial::where('published', true)->latest()->take(3)->get();
    
            return view('car_rental_main/home',compact('latestCars','latestTestimonials'));
    } 
        
    public function showListings()
    {
        $cars = Car::where('active', true)->paginate(6);  
            $latestTestimonials = Testimonial::where('published', true)->latest()->take(3)->get();
    
            return view('car_rental_main/listing',compact('cars','latestTestimonials'));
    } 

    public function showTestimonials()
    {
        $testimonials = Testimonial::where('published', true)->get();  
    
        return view('car_rental_main/testimonials',compact('testimonials'));
    } 

    public function showBlogs()
    {
        return view('car_rental_main/blog');
    } 

    public function showAbout()
    {
        return view('car_rental_main/about');
    } 

    public function showContact()
    {
        return view('car_rental_main/contact');
    } 

        

   

   
    public function showSingleCar(string $id)
    {
        
        $car = Car ::findOrFail($id);
        $categories = Category::select('id', 'name')->get();
        return view('car_rental_main/single',compact('car','categories'));

    }


    public function sendMessage(Request $request)
    {
        try {

            $messages = [
                'first_name.required' => "First name is required",
                'last_name.required'  => "Last name is required",
                'email.required'      => "Email is required",
                'message.required'    => "Message is required",
            
            ];
 
            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'message' => 'required|string',
                'email' => 'required|email|string',
            ], $messages);

     
            // Set isRead to false in the $data array
            $data['isRead'] = false;
 

            Message::create($data);


            return redirect()->route('contact')->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            Log::error('Error occurred while sending message : ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to send message. Please try again later.');
        }
    }

    


}
