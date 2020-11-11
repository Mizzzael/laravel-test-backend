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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('immobile')->group(function() 
{

    Route::get('/', 'API\ImmobileController@index');
    Route::get('/emails', 'API\ImmobileController@getAllEmailsFromImmobiles');
    Route::get('/{id}', 'API\ImmobileController@getImmobileToContract');
    
    Route::post('/', 'API\ImmobileController@store');
    Route::post('/states', 'API\ImmobileController@getAllStatesFromImmobilesByEmail');
    Route::post('/neighborhood', 'API\ImmobileController@getAllNeighborhoodFromImmobilesByEmailAndState');
    Route::post('/filter', 'API\ImmobileController@getAllImmoblilesByEmailAndStateAndNeighborhood');

    Route::delete('/{id}', 'API\ImmobileController@disabled');
});

Route::prefix('contract')->group(function() 
{

    Route::get('/{id}', 'API\ContractController@show');
    Route::post('/', 'API\ContractController@store');

});