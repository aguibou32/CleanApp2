<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::apiResource('/users', 'UsersController');
// Route::group(['prefix' => 'users'], function(){
//     Route::apiResource('/{user}/address', 'LocationAddressController');
// });

// Route::apiResource('/requests', 'RequestsController');
// Route::apiResource('/report_dumping', 'ReportDumpingController');
// Route::apiResource('/collections', 'CollectionsController');
// Route::apiResource('/collection_feedbacks', 'CollectionFeedbacksController');
// Route::apiResource('/collection_invoices', 'CollectionInvoicesController');
// Route::apiResource('/billing_information', 'BillingInformationController');