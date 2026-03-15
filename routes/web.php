<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\AboutController;
use App\Http\Controllers\Clients\ServicesController;
use App\Http\Controllers\Clients\ToursController;
use App\Http\Controllers\Clients\DestinationController;
use App\Http\Controllers\Clients\TravelGuidesController;
use App\Http\Controllers\Clients\TestimonialController;
use App\Http\Controllers\Clients\BookingController as ClientsBookingController;     
use App\Http\Controllers\Clients\ContactController;
use App\Http\Controllers\Clients\TourdetailController;
use App\Http\Controllers\Clients\BlogsController;
use App\Http\Controllers\Clients\BlogDetailsController;
use App\Http\Controllers\clients\informationController;
use App\Http\Controllers\Clients\LoginController;
use App\Http\Controllers\Clients\SocialController;
use App\Http\Controllers\Clients\SearchController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/Tours', [ToursController::class, 'index'])->name('Tours');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
Route::get('/tour-detail/{id}',[TourdetailController::class, 'index'])->name('tour-detail');
Route::get('/travel-guides', [TravelGuidesController::class, 'index'])->name('travel-guides');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');

Route::get('/contact', function () {
    return view('Clients.contact');
})->name('contact');
Route::post('/contact/send',[ContactController::class,'send'])->name('contact.send');

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blog-details', [BlogDetailsController::class, 'index'])->name('blog-details');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/user-profile', [informationController::class, 'index'])->name('infor');
Route::post('/user-profile',[informationController::class,'update'])->name('user.update');
Route::post('/change-password',[informationController::class,'changePassword'])->name('user.password');
Route::post('/upload-avatar',[informationController::class,'uploadAvatar'])->name('user.avatar');

Route::middleware('user')->group(function(){

    Route::get('/booking/{id}', [ClientsBookingController::class,'index'])->name('booking.index');

    Route::post('/booking/{id}', [ClientsBookingController::class,'store'])->name('booking.store');
    Route::get('/booking-history',[ClientsBookingController::class,'history'])->name('booking-history');
    Route::post('/booking/cancel/{id}',[ClientsBookingController::class,'cancel'])->name('booking.cancelled');
    Route::post('/booking/rebook/{id}',[ClientsBookingController::class,'rebook'])->name('booking.rebook');
    Route::get('/booking/detail/{id}',[ClientsBookingController::class,'detail'])->name('booking.detail');

});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/forgot-password',[LoginController::class,'sendReset'])
->name('password.send');

Route::get('/reset-password/{token}',[LoginController::class,'resetPage'])
->name('password.reset.page');

Route::post('/reset-password',[LoginController::class,'updatePassword'])
->name('password.update');



    /* ======================
       DASHBOARD
    ====================== */

  Route::prefix('admin')->middleware('admin')->group(function(){

    /* ======================
       DASHBOARD
    ====================== */

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    /* ======================
       TOUR MANAGEMENT
    ====================== */

    Route::get('/tours',[TourController::class,'index'])->name('admin.tours.index');

    Route::get('/tours/create',[TourController::class,'create'])->name('admin.tours.create');

    Route::post('/tours/store',[TourController::class,'store'])->name('admin.tours.store');

    Route::get('/tours/edit/{id}',[TourController::class,'edit'])->name('admin.tours.edit');

    Route::post('/tours/update/{id}',[TourController::class,'update'])->name('admin.tours.update');

    Route::delete('/tours/delete/{id}',[TourController::class,'delete'])->name('admin.tours.delete');


    /* ======================
       BOOKING MANAGEMENT
    ====================== */


Route::get('/bookings',[AdminBookingController::class,'index'])->name('admin.bookings.index');

Route::get('/bookings/{id}',[AdminBookingController::class,'show'])->name('admin.bookings.show');

Route::post('/bookings/{id}/status',[AdminBookingController::class,'updateStatus'])->name('admin.bookings.update_status');

    


    /* ======================
       USER MANAGEMENT
    ====================== */

    Route::get('/users',[UserController::class,'index'])->name('admin.users');

    Route::get('/users/delete/{id}',[UserController::class,'delete'])->name('admin.users.delete');

    Route::get('/users/block/{id}',[UserController::class,'block'])->name('admin.users.block');

    Route::get('/users/active/{id}',[UserController::class,'active'])->name('admin.users.active');

});
/* Google */
Route::get('/auth/google',[SocialController::class,'google']);
Route::get('/auth/google/callback',[SocialController::class,'googleCallback']);

/* Facebook */
Route::get('/auth/facebook',[SocialController::class,'facebook']);
Route::get('/auth/facebook/callback',[SocialController::class,'facebookCallback']);

Route::get('/404', function () {
    return view('Clients.errors.404');
})->name('clients.404');
