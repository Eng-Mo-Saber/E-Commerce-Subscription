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
use App\Http\Controllers\Api\Web\AccountDetails\AccountDetailsController;
use App\Http\Controllers\Api\Web\Cart\CartController;
use App\Http\Controllers\Api\Web\Category\CategoryWebController;
use App\Http\Controllers\Api\Web\category\SingleCategoryController;
use App\Http\Controllers\Api\Web\Favorite\FavoriteController;
use App\Http\Controllers\Api\Web\HomeWebController;
use App\Http\Controllers\Api\Web\Order\OrderWebController;
use App\Http\Controllers\Api\Web\Order\TrackOrderController;
use App\Http\Controllers\Api\Web\Payment\PaymentController;
use App\Http\Controllers\Api\Web\Payment\PaymentInvoiceController;
use App\Http\Controllers\Api\Web\Payment\PaymentSubscriptionController;
use App\Http\Controllers\Api\Web\product\SingleProductController;
use App\Http\Controllers\Api\Web\ResetPassword\ForgotPasswordController;
use App\Http\Controllers\Api\Web\ResetPassword\ResetPasswordController;
use App\Http\Controllers\Api\Web\Service\ServiceWebController;
use App\Http\Controllers\Api\Web\Subscription\MySubscriptionController;
use App\Http\Controllers\Api\Web\Subscription\SubscriptionWebController;
use App\Models\Order;
use App\Models\Product;
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
//No Auth
Route::get('/',[HomeWebController::class , 'noAuth']);
Route::get('/single-category/{id}', [SingleCategoryController::class, 'indexNoAuth']);
Route::get('/category', [CategoryWebController::class, 'index']);
Route::post('/register',[AuthController::class , 'register']);
Route::post('/login',[AuthController::class , 'login']);
Route::post('/check-email-password', [ForgotPasswordController::class, 'send_email']);
Route::get('/reset-password/{token}/{email}', [ResetPasswordController::class, 'index']);
Route::post('/reset', [ResetPasswordController::class, 'reset_password']);
//payment
Route::get('/payment/handle', [PaymentSubscriptionController::class, 'handlePayment']);
Route::get('/payment-order/handle', [OrderWebController::class, 'handleOrderPayment']);


// --------------------------------------------------------------------------
//auth
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/home',[HomeWebController::class , 'auth']);
    Route::get('/user-details',[AccountDetailsController::class , 'index']);
    Route::post('/edit-account-details', [AccountDetailsController::class, 'editData']);
    Route::post('/update-password-account', [AccountDetailsController::class, 'updatePassword']);
    Route::get('/services',[ServiceWebController::class , 'index']);
    Route::get('/subscription/{id}', [SubscriptionWebController::class, 'index']);
    Route::get('/my-subscription', [MySubscriptionController::class, 'index']);
    Route::delete('/cancel-my-subscription/{id}', [MySubscriptionController::class, 'destroy']);
    Route::get('/paymentInvoice/{id}', [PaymentInvoiceController::class, 'show']);
    //payment subscription
    Route::get('/payment/{id}', [PaymentSubscriptionController::class, 'index']);
    Route::post('/payment-kashier', [PaymentSubscriptionController::class, 'redirectToKashier']);
    Route::get('/payment-invoice/{id}', [PaymentSubscriptionController::class, 'show']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::get('/favorites/toggle/{id}', [FavoriteController::class, 'add_favorite']);
    Route::delete('/remove-favorite/{id}', [FavoriteController::class, 'destroy']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/add-cart/{id}', [CartController::class, 'store']);
    Route::delete('/delete-cart/{id}', [CartController::class, 'destroy']);
    Route::get('/single-product/{id}',[SingleProductController::class , 'index']);
    Route::get('/single-category-auth/{id}', [SingleCategoryController::class, 'indexAuth']);
    Route::apiResource("/orders",OrderWebController::class);
    Route::post('/track-status-order',[TrackOrderController::class , 'show_status_order']);
    Route::post('/logout',[AuthController::class , 'logout']);
    
});


// --------------------------------------------------------------------------
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