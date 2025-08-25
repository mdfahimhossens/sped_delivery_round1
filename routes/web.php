<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DeliveryZoneController;
use App\Http\Controllers\DeliveryManController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

// Restaurants
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/create', [RestaurantController::class, 'create']);
Route::post('/restaurants', [RestaurantController::class, 'store']);
Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit']);
Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);
Route::resource('restaurants', RestaurantController::class);

// Delivery Zones
Route::get('/delivery-zones', [DeliveryZoneController::class, 'index'])->name('delivery-zones.index');
Route::get('/restaurants/{restaurant}/delivery-zone/create', [DeliveryZoneController::class,'create'])->name('delivery-zones.create');
Route::post('/delivery-zones/store', [DeliveryZoneController::class,'store'])->name('delivery-zones.store');
Route::get('/delivery-zones/{zone}/edit', [DeliveryZoneController::class, 'edit'])->name('delivery-zones.edit');
Route::put('/delivery-zones/{zone}', [DeliveryZoneController::class, 'update'])->name('delivery-zones.update');
Route::delete('/delivery-zones/{zone}', [DeliveryZoneController::class, 'destroy'])->name('delivery-zones.destroy');

// Delivery Men
Route::get('/delivery-men', [DeliveryManController::class,'index'])->name('delivery-men.index');
Route::get('/delivery-men/create', [DeliveryManController::class,'create'])->name('delivery-men.create'); // <-- এইটা দরকার
Route::post('/delivery-men', [DeliveryManController::class,'store'])->name('delivery-men.store');
Route::get('/delivery-men/{id}/edit', [DeliveryManController::class,'edit'])->name('delivery-men.edit');
Route::put('/delivery-men/{id}', [DeliveryManController::class,'update'])->name('delivery-men.update');
Route::delete('/delivery-men/{id}', [DeliveryManController::class,'destroy'])->name('delivery-men.destroy');

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');