<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RoomTypeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Hotels
Route::prefix('hotels')->group(function(){
    Route::get('/', [HotelController::class, 'index']);
    Route::post('/', [HotelController::class, 'store']);

    Route::prefix('{hotelId}')->middleware(['findHotel'])->group(function(){
        Route::get('/', [HotelController::class, 'show']);
        Route::put('/', [HotelController::class, 'update']);
        Route::delete('/', [HotelController::class, 'destroy']);
    });

});

// Room Types
Route::prefix('room-types')->group(function(){
    Route::get('/', [RoomTypeController::class, 'index']);
    Route::post('/', [RoomTypeController::class, 'store']);

    Route::prefix('{roomTypeId}')->middleware(['findRoomType'])->group(function(){
        Route::get('/', [RoomTypeController::class, 'show']);
        Route::put('/', [RoomTypeController::class, 'update']);
        Route::delete('/', [RoomTypeController::class, 'destroy']);

        // Prices
        Route::prefix('prices')->group(function(){
            Route::get('/', [PriceController::class, 'index']);
            Route::post('/', [PriceController::class, 'store']);

            Route::prefix('{priceId}')->middleware(['findPrice'])->group(function(){
                Route::get('/', [PriceController::class, 'show']);
                Route::put('/', [PriceController::class, 'update']);
                Route::delete('/', [PriceController::class, 'destroy']);
            });
        
        });

    });

});
