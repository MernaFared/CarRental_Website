<?php

use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/welcome', function () {
//     return view('welcome');
// }); // make comment

Auth::routes(['verify'=>true]);


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('cars/{id}', [HomeController::class, 'showSingleCar'])->name('carDetails');


Route::get('/listings', [HomeController::class, 'showListings'])->name('listings');

Route::get('/testimonials', [HomeController::class, 'showTestimonials'])->name('testimonials');
Route::get('/blog', [HomeController::class, 'showBlogs'])->name('blog');
Route::get('/about', [HomeController::class, 'showAbout'])->name('about');
Route::get('/contact', [HomeController::class, 'showContact'])->name('contact');

Route::post('/send', [HomeController::class, 'sendMessage'])->name('send_message');



// 
Route::get('/email/verify', function () {
    return view('auth/verify');
})-> name('verification.notice'); 

// main project
// Route::get('/home', function () {
//     return view('car_rental_main/home');
// }); 



// Admin
Route::prefix('admin')->middleware('auth')->group(function () {
    // Cars

    Route::get('/cars', [CarController::class, 'index'])->name('admin.cars');
    Route::get('/cars/add', [CarController::class, 'create'])->name('admin.addCar');
    Route::post('/cars', [CarController::class, 'store'])->name('admin.storeCar');

    Route::get('/cars/edit/{id}', [CarController::class, 'edit'])->name('admin.editCar');
    
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('admin.updateCar');

    Route::get('/cars/delete/{id}', [CarController::class, 'destroy'])->name('admin.deleteCar');

    

    // User
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/add', [UserController::class, 'create'])->name('admin.addUser');
    Route::post('/users', [UserController::class, 'store'])->name('admin.storeUser');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.editUser');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.updateUser');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.deleteUser');




     // Category
     Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
 
    Route::get('/categories/add', [CategoryController::class, 'create'])->name('admin.addCategory');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.storeCategory');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.editCategory');
    
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.updateCategory');

    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.deleteCategory');



    // Testimonials -- testimonials -- Testimonial
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials');
    Route::get('/testimonials/add', [TestimonialController::class, 'create'])->name('admin.addTestimonials');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('admin.storeTestimonial');

    Route::get('/testimonials/edit/{id}', [TestimonialController::class, 'edit'])->name('admin.editTestimonials');
    
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('admin.updateTestimonial');

    Route::get('/testimonials/delete/{id}', [TestimonialController::class, 'destroy'])->name('admin.deleteTestimonial');


    
    // Messages -- messages -- Message 
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('admin.showMessage');
    Route::get('/messages/delete/{id}', [MessageController::class, 'destroy'])->name('admin.deleteMessage');





    // Login
    
    Route::get('/login', function () {
        return view('admin/login');
    })->name('admin.login');




// user 




});

