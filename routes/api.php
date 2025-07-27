<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Dashboard\CategoryController;
use App\Http\Controllers\Api\Dashboard\HomeController;
use App\Http\Controllers\Api\Dashboard\OrderController;
use App\Http\Controllers\Api\Dashboard\ProductController;
use App\Http\Controllers\Api\Dashboard\ServiceController;
use App\Http\Controllers\Api\Dashboard\SubscriptionController;
use App\Http\Controllers\Api\Dashboard\UserController;
use App\Http\Controllers\Api\Dashboard\UserSubscriptionController;
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

Route::post('/register',[AuthController::class , 'register']);
Route::post('/login',[AuthController::class , 'login']);

//auth
Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout',[AuthController::class , 'logout']);
    
});
//Dashboard
Route::middleware('auth:sanctum','admin')->group(function(){
    Route::get('/dashboard-home',[HomeController::class , 'index']);
    Route::apiResource("/dashboard-users",UserController::class);
    Route::apiResource("/dashboard-categories",CategoryController::class);
    Route::apiResource("/dashboard-products",ProductController::class);
    Route::get("/dashboard-showCategoriesInProduct",[ProductController::class , 'showCategories']);
    //order----
    Route::get("/dashboard-orders",[OrderController::class , 'index']);
    Route::get("/dashboard-order-accepted/{id}",[OrderController::class , 'accepted']);
    Route::get("/dashboard-order-unaccepted/{id}",[OrderController::class , 'unAccepted']);
    Route::get("/dashboard-order-details/{id}",[OrderController::class , 'details']);
    //----------
    Route::apiResource("/dashboard-services",ServiceController::class);
    Route::apiResource("/dashboard-subscriptions",SubscriptionController::class);
    Route::get("/dashboard-showServicesInSub",[SubscriptionController::class , 'showServicesInSub']);
    Route::apiResource("/dashboard-userSubscriptions",UserSubscriptionController::class);

});