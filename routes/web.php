<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController as AdminContactUsController;
use App\Http\Controllers\Frontend\CmsController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\ForgotPasswordController;
use App\Http\Controllers\Frontend\ProductController;



// Clear cache
Route::get('clear', function () {
    Artisan::call('optimize:clear');
    return "Optimize clear has been successfully";
});

// Route::get('/', [AuthController::class, 'login'])->name('admin.login');
Route::get('/', [CmsController::class, 'home'])->name('home');
Route::get('/about', [CmsController::class, 'about'])->name('about');
Route::get('/contact', [CmsController::class, 'contact'])->name('contact');
Route::get('/product/{slug}', [CmsController::class, 'products'])->name('product');
Route::get('/product-detail/{slug}/{id}', [CmsController::class, 'productDetail'])->name('product-detail');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/blogs', [CmsController::class, 'blogs'])->name('blogs');
Route::post('/register-store', [AuthController::class, 'registerStore'])->name('register.store');
Route::post('/user-login-check', [AuthController::class, 'loginCheck'])->name('login.check');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/remove-product-from-cart', [CartController::class, 'removeProductFromCart'])->name('remove-product-from-cart');
Route::post('/decrease-product-quantity', [CartController::class, 'decreaseQuantity'])->name('decrease-product-quantity'); // Decrease product quantity
Route::post('/increase-product-quantity', [CartController::class, 'increaseQuantity'])->name('increase-product-quantity'); // Increase product quantity
Route::get('/forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password'); // forget password
Route::post('/forget-password-check', [ForgotPasswordController::class, 'forgetPasswordCheck'])->name('forget.password.check');
Route::get('/reset-password/{id}/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password'); // reset password
Route::post('/reset-password-check', [ForgotPasswordController::class, 'resetPasswordCheck'])->name('reset.password.check'); // reset password check
Route::post('/product-search', [ProductController::class, 'productSearch'])->name('product.search');
Route::get('/product-filter', [ProductController::class, 'productFilter'])->name('product.filter'); // product filter

Route::middleware('customer')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist'); // category wise product
    Route::post('/update-wishlist', [WishlistController::class, 'updateWishlist'])->name('update-wishlist'); // update wishlist
    Route::get('/delete-wishlist/{id}', [WishlistController::class, 'deleteWishlist'])->name('delete-wishlist'); // delete wishlist
    Route::get('/checkout/{id?}', [CartController::class, 'checkout'])->name('checkout');
});

Route::post('forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('admin.forget.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');
Route::get('forget-password/show', [ForgetPasswordController::class, 'forgetPasswordShow'])->name('admin.forget.password.show');
// Route::get('reset-password/{id}/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('admin.reset.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');


Route::get('/admin', [AdminAuthController::class, 'admin'])->name('admin');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/login-check', [AdminAuthController::class, 'loginCheck'])->name('admin.login.check');  //login check
    Route::group(['middleware' => 'admin'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::prefix('password')->group(function () {
            Route::get('/', [ProfileController::class, 'password'])->name('admin.password'); // password change
            Route::post('/update', [ProfileController::class, 'passwordUpdate'])->name('admin.password.update'); // password update
        });

        Route::resources([
            'customers' => CustomerController::class,
            'categories' => CategoryController::class,
            'products' => AdminProductController::class,
        ]);
        //  Category Routes
        Route::get('/changeCategoryStatus', [CategoryController::class, 'changeCategoriesStatus'])->name('categories.change-status');
        Route::prefix('categories')->group(function () {
            Route::get('/category-delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        });
        //  Customer Routes
        Route::prefix('customers')->group(function () {
            Route::get('/customer-delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
        });
        Route::get('/changeCustomerStatus', [CustomerController::class, 'changeCustomersStatus'])->name('customers.change-status');

        //  Product Routes
        Route::get('/changeProductsStatus', [AdminProductController::class, 'changeProductsStatus'])->name('products.change-status');
        Route::get('/changeFeaturedProduct', [AdminProductController::class, 'changeFeaturedProduct'])->name('products.featured-product');

        //contact us
        Route::get('/contact-us', [AdminContactUsController::class, 'contactUs'])->name('admin.contact-us');
    });
});
