<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@mainPage');

//admin
Route::get('admin', 'MainController@adminMainPage');

//admin/air
Route::resource('schedule', 'AdminScheduleController');
Route::resource('plane', 'AdminPlaneController');
Route::resource('airport', 'AdminAirportController');
Route::resource('airline', 'AdminAirlineReservationController');

//admin/other
Route::resource('a_consumer', 'AdminConsumerController');
Route::resource('nation', 'AdminNationController');
Route::resource('city', 'AdminCityController');

//admin/hotel
Route::resource('a_hotel', 'AdminHotelController');
Route::resource('a_hroom', 'AdminHroomController');
Route::resource('a_hreservation', 'AdminHReservationController');

//admin/package
Route::resource('a_tour', 'AdminTourController');
Route::resource('a_package_schedule', 'AdminPackageScheduleController');
Route::resource('a_package', 'AdminPackageController');
Route::resource('a_package_reservation', 'AdminPackageReservationController');

//air
Route::get('/air', [AirController::class, 'index']);
Route::post('/air/search', [AirController::class, 'search']);
Route::post('/air/reservation', [AirController::class, 'reservation']);
Route::post('/air/storage', [AirController::class, 'storage']);

//consumer
Route::resource('consumer', 'ConsumerController');
Route::post('consumer_login',  'ConsumerController@login');
Route::get('consumer_logout',  'ConsumerController@logout');
Route::resource('consumer_reservation', 'ReservationController');
//package
Route::resource('package', 'PackageController');
Route::post('package/{id}/order/', 'PackageController@order')->name('package.order');
//hotel
Route::resource('hotel','HotelController');
Route::resource('hroom','HroomController');

Route::get('login', 'HotelController@login')->name('hotel.login');
Route::get('logout', 'HotelController@logout')->name('hotel.logout');
Route::post('order', 'HotelController@order')->name('hotel.order');
Route::post('reservation', 'HotelController@reservation')->name('hotel.reservation');


//blog
Route::resource('blog', 'BlogController');
Route::post('blog/upload', 'BlogController@upload')->name('blog.upload');

//comment

Route::post('comment/store', 'CommentController@store');
Route::resource('comment','CommentController', ['only'=> ['store','destroy']]);
Route::get('/comment/{id}','CommentController@destroy' );
