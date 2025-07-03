<?php

use App\Http\Controllers\Auth\AccountDetailsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\AddCategoryController;
use App\Http\Controllers\Dashboard\AddProductController;
use App\Http\Controllers\Dashboard\AddServiceController;
use App\Http\Controllers\Dashboard\AddSubscriptionController;
use App\Http\Controllers\Dashboard\AddUserController;
use App\Http\Controllers\Dashboard\DashboardHomeController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ShowPaymentInvoiceController;
use App\Http\Controllers\Dashboard\ShowUserSubscriptionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Orders\OrderDetailsController;
use App\Http\Controllers\Orders\OrderRecievedController;
use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Orders\TrackOrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\BranchesController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\CheckoutController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\FavoritesController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\MySubscriptionController;

use App\Http\Controllers\web\PaymentController;
use App\Http\Controllers\web\PrivacyPolicyController;

use App\Http\Controllers\web\ReadController;
use App\Http\Controllers\web\ServiceController;
use App\Http\Controllers\web\ShopController;
use App\Http\Controllers\Web\SingleCategoryController;
use App\Http\Controllers\web\SingleProductController;
use App\Http\Controllers\web\SubscriptionController;
use App\Models\Service;
use App\Models\Subscription;
use function Psy\sh;
use Illuminate\Support\Facades\Route;
use Laravel\SerializableClosure\Serializers\Signed;
use PgSql\Lob;
use PhpParser\Node\Stmt\For_;








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

Route::get('/test', [HomeController::class, 'test']);

Route::get('/', [HomeController::class, 'index'])->name('home.page');
Route::get('/login', [loginController::class, 'index'])->name('login.page');
Route::get('/register', [registerController::class, 'index'])->name('register.page');
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password.page');
Route::get('/single-category/{id}', [SingleCategoryController::class, 'index'])->name('single-category.page');
Route::get('/single-category/{id}', [SingleCategoryController::class, 'index'])->name('single-category.page');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.page');
Route::get('/branches', [BranchesController::class, 'index'])->name('branches.page');
Route::get('/about', [AboutController::class, 'index'])->name('about.page');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.page');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy.page');
// Route controller login and register

Route::post('/register-user', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login-user', [LoginController::class, 'login'])->name('login.user');

// Route::get('/refund-policy', [PagesController::class, 'refund_policy'])->name('refund-policy.page');



Route::middleware('auth')->group(function () {
        
    
    Route::get('/account-details', [AccountDetailsController::class, 'index'])->name('account-details.page');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.page');
    //service
    route::get('/service', [ServiceController::class, 'index'])->name('service.page');
    //subscription
    Route::get('/subscription/{id}', [SubscriptionController::class, 'index'])->name('subscription.page');
    //my-subscription
    Route::get('/my-subscription', [MySubscriptionController::class, 'index'])->name('my-subscription.page');
    //payment
    Route::get('/payment/{id}', [PaymentController::class, 'index'])->name('payment.page');
    Route::post('/add-payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment-invoice/{id}', [PaymentController::class, 'show'])->name('payment-invoice.page');
    //single product
    Route::get('/single-product/{id}', [SingleProductController::class, 'index'])->name('single-product.page');
    //favorites
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.page');
    Route::get('/Add-favorite/{id}', [FavoritesController::class, 'Add_favorite'])->name('Add-favorites.page');
    Route::get('/Remove-favorite/{id}', [FavoritesController::class, 'destroy'])->name('Remove-favorites.page');
    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.page');
    Route::post('/cart/{id}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    //checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.page');
    //logout
    Route::get('/logout-user', [LoginController::class, 'logout'])->name('logout.user');
    //orders
    //عرض الصفحه للمستخدم
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.page');
    //اضاة الاوردرات
    Route::post('/add-orders', [OrdersController::class, 'store'])->name('orders.store');
    //حذف الاوردر
    Route::get('/delete-orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');

    //عرض تفاصيل الاوردر للمستخدم
    Route::get('/order-details/{id}', [OrderDetailsController::class, 'index'])->name('order-details.page');
    Route::get('/track-order', [TrackOrderController::class, 'index'])->name('track-order.page');
    Route::post('/track-status-order', [TrackOrderController::class, 'show_status_order'])->name('track-status-order');
});




// Dashboard Routes
Route::middleware(['auth', 'admin'])->group(function () {
    //show pages  بيعرضهم في ال 
    Route::get('/dashboard-home', [DashboardHomeController::class, 'index'])->name('page.dashboard');
    Route::get('/dashboard-showUsers', [AddUserController::class, 'index'])->name('dashboard.showUsers');
    Route::get('/dashboard-showCategories', [AddCategoryController::class, 'index'])->name('dashboard.showCategories');
    Route::get('/dashboard-showProducts', [AddProductController::class, 'index'])->name('dashboard.showProducts');
    Route::get('/dashboard-showService', [AddServiceController::class, 'index'])->name('dashboard.showService');
    Route::get('/dashboard-showSubscription', [AddSubscriptionController::class, 'index'])->name('dashboard.showSubscription');
    Route::get('/dashboard-showUserSubscription', [ShowUserSubscriptionsController::class, 'index'])->name('dashboard.showUserSubscription');
    Route::get('/dashboard-showPaymentInvoice/{id}', [ShowPaymentInvoiceController::class, 'index'])->name('dashboard.showPaymentInvoice');
    //orders
    Route::get('/dashboard-showOrders', [OrderController::class, 'index'])->name('dashboard.showOrders');
    //قبول الاوردر
    Route::get('/dashboard-AcceptedOrder/{id}', [OrderController::class, 'accepted'])->name('dashboard.acceptedOrder');
    //رفض الاوردر
    Route::get('/dashboard-UnAcceptedOrder/{id}', [OrderController::class, 'unAccepted'])->name('dashboard.unAcceptedOrder');
    //عرض تفاصيل الاوردر
    Route::get('/dashboard-DetailsOrder/{id}', [OrderController::class, 'details'])->name('dashboard.detailsOrder');


    // add and update pages دا بيعرض الفورم اللي بضيف منها او بعدل منها
    //user
    Route::get('/dashboard-addAdmin', [AddUserController::class, 'create'])->name('dashboard.addAdmin');
    Route::get('/dashboard-updateAdmin/{id}', [AddUserController::class, 'show'])->name('dashboard.updateAdmin');
    //category
    Route::get('/dashboard-addCategory', [AddCategoryController::class, 'create'])->name('dashboard.addCategory');
    Route::get('/dashboard-updateCategory/{id}', [AddCategoryController::class, 'show'])->name('dashboard.updateCategory');
    //product
    Route::get('/dashboard-addProduct', [AddProductController::class, 'create'])->name('dashboard.addProduct');
    Route::get('/dashboard-updateProduct/{id}', [AddProductController::class, 'show'])->name('dashboard.updateProduct');
    //service
    Route::get('/dashboard-addService', [AddServiceController::class, 'create'])->name('dashboard.addService');
    Route::get('/dashboard-updateService/{id}', [AddServiceController::class, 'show'])->name('dashboard.updateService');
    //subscription
    Route::get('/dashboard-addSubscription', [AddSubscriptionController::class, 'create'])->name('dashboard.addSubscription');
    Route::get('/dashboard-updateSubscription/{id}', [AddSubscriptionController::class, 'show'])->name('dashboard.updateSubscription');


    //Add and update controller routes post
    //user
    Route::post('/dash-addAdmin', [AddUserController::class, 'store'])->name('AddAdmin.store');
    Route::post('/dash-updateAdmin/{id}', [AddUserController::class, 'update'])->name('updateAdmin.update');
    //category
    Route::post('/dash-addCategory', [AddCategoryController::class, 'store'])->name('AddCategory.store');
    Route::post('/dash-updateCategory/{id}', [AddCategoryController::class, 'update'])->name('updateCategory.update');
    //product
    Route::post('/dash-addProduct', [AddProductController::class, 'store'])->name('AddProduct.store');
    Route::post('/dash-updateProduct/{id}', [AddProductController::class, 'update'])->name('updateProduct.update');
    //service
    Route::post('/dash-addService', [AddServiceController::class, 'store'])->name('AddService.store');
    Route::post('/dash-updateService/{id}', [AddServiceController::class, 'update'])->name('updateService.update');
    
    //subscription
    Route::post('/dash-addSubscription', [AddSubscriptionController::class, 'store'])->name('AddSubscription.store');
    Route::post('/dash-updateSubscription/{id}', [AddSubscriptionController::class, 'update'])->name('updateSubscription.update');
    
    //delete controller
    //user
    Route::get('/dash-deleteAdmin/{id}', [AddUserController::class, 'destroy'])->name('DeleteAdmin.destroy');
    //category
    Route::get('/dash-deleteCategory/{id}', [AddCategoryController::class, 'destroy'])->name('deleteCategory.destroy');
    //product
    Route::get('/dash-deleteProduct/{id}', [AddProductController::class, 'destroy'])->name('deleteProduct.destroy');
    //service
    Route::get('/dash-deleteService/{id}', [AddServiceController::class, 'destroy'])->name('deleteService.destroy');
    //Subscription
    Route::get('/dash-deleteSubscription/{id}', [AddSubscriptionController::class, 'destroy'])->name('deleteSubscription.destroy');
});


