<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Generator;

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
   
// Route::get('/qrcode', function(){
//     return view('emails.invoice');
// });

// Route::post('/charge', function(Request $request){
    
// });

Route::get('/', function () {
    // Alert::success('Success Message');
    return view('welcome');
})->name('welcome');

Route::get('/location', function(){
    return view('location'); // once you get a credit card, you can complete this one
});

Route::get('/direction', function(){
     return view('collection.direction'); 
});


Route::get('/qrcode', function(){

    QrCode::generate('Name: Mohamed Surname: Gatoo Number::07123244354', '../public/qrcodes/qrcode.svg', 'png');

    // $qrcode = new Generator;
    // $qrcode->size(500)->generate('Make a qrcode without Laravel!');
});


Route::post('/payment', 'CollectionsController@payment')->name('payment');

Route::get('/map', 'CollectionsController@map')->name('map');


Route::post('/charge', 'CollectionsController@charge')->name('charge');

Auth::routes(['verify'=>true]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Route::resource('users', 'UsersController');
Route::get('activate/{id}', 'UsersController@activate')->name('activate');

Route::resource('profile', 'ProfileController')->middleware('auth');
Route::resource('informal_invoice', 'InformalInvoiceController')->middleware('auth');


// Route::resource('collection', 'RequestCollectionController')->middleware('auth');
// Route::get('request_collection/{id}', 'RequestCollectionController@request_collection')->name('request_collection')->middleware('auth');;
// // Route::resource('callback', 'RequestCallBackController')->middleware('auth');;
Route::resource('/users', 'UsersController');

// url for data export to excel
Route::get('/export_users', 'UsersController@export_users')->name("export_users");
Route::get('/export_requests', 'RequestsController@export_requests')->name("export_requests");
Route::get('/export_dumping_requests', 'ReportDumpingController@export_dumping_requests')->name("export_dumping_requests");


// Route for informal collectors
Route::resource('/informal_collector', 'InformalColllectorController');

Route::group(['prefix' => 'users'], function(){
    Route::resource('/{user}/address', 'LocationAddressController');
});

Route::resource('/requests', 'RequestsController');
Route::resource('/report_dumping', 'ReportDumpingController');
Route::resource('/collections', 'CollectionsController');
Route::post('/sell_collection', 'CollectionsController@sell')->name('sell_collection');
Route::post('/create_invoice', 'CollectionsController@create_invoice')->name('create_invoice');
Route::resource('/collection_feedbacks', 'CollectionFeedbacksController');

Route::resource('/billing_information', 'BillingInformationController');

Route::get('/sign-in/github', 'Auth\LoginController@github')->name('sign-in');
Route::get('/sign-in/github/redirect', 'Auth\LoginController@githubRedirect');
