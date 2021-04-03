<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\backend\admin\categories\CategoriesController;
use App\Http\Controllers\backend\admin\categories\SubCategoriesController;
use App\Http\Controllers\backend\admin\DashboardController;
use App\Http\Controllers\backend\admin\products\ProductsController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Route::name('frontend.')->group(function(){

// });

//Products releted routes.
Route::get('/', [ProductController::class,'productsIndex'])->name('frontend.product.index');
Route::get('/product/{slug}', [ProductController::class, 'productShow'])->name('frontend.product.show');

//Cart releted routes.
Route::get('/cart/quantity', [CartController::class, 'cartCount'])->name('cart.quantity');
Route::get('/cart', [CartController::class, 'cartIndex'])->name('cart.index');
Route::post('/cart', [CartController::class, 'cartStore'])->name('cart.store');
Route::post('/cart/destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');
Route::get('/cart/clear', [CartController::class, 'cartClear'])->name('cart.clear');
Route::get('/checkout', [CartController::class,'checkout'])->name('checkout');
Route::get('/change.qty/{product}', [CartController::class, 'changeQty'])->name('change.qty');

//Auth releted routes.
Route::middleware('guest')->group(function () {
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'registerLogic']);

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'loginLogic']);

});
Route::get('/activate/{token}', [AuthController::class, 'activate'])->name('activate');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/order', [CartController::class, 'orderProcess'])->name('order');

});

            //=======================================//
           //Backend Routes For Deshboard Operations//
// =================================================================
// =================================================================

Route::name('admin.')->prefix('admin')->group(function () {

    // Deshboard 

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products 
    Route::get('/products', [ProductsController::class, 'products'])->name('products');

    // Category 
    Route::get('/categories', [CategoriesController::class, 'categories'])->name('categories');
    Route::get('/categories/new', [CategoriesController::class, 'newCategory'])->name('category.new');
    Route::post('/categories', [CategoriesController::class, 'storeCategories']);
    Route::get('/categories/{id}', [CategoriesController::class, 'categoryShow'])->name('category.show');
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'categoryEdit'])->name('category.edit');
    Route::put('/categories/{id}', [CategoriesController::class, 'categoryUpdate'])->name('category.update');
    Route::delete('/categories/{id}', [CategoriesController::class, 'categoryDelete'])->name('category.delete');

    //Sub Category
    Route::get('/subcategories', [SubCategoriesController::class, 'subCategories'])->name('subcategories');
    Route::get('/subcategories/new', [SubCategoriesController::class, 'newsubCategory'])->name('subcategory.new');
    Route::post('/subcategories', [SubCategoriesController::class, 'storesubCategories']);
    Route::get('/subcategories/{id}', [SubCategoriesController::class, 'showSubCategory'])->name('subcategory.show');
    Route::get('/subcategories/{id}/edit', [SubCategoriesController::class, 'subCategoryEdit'])->name('subcategory.edit');
    Route::put('/subcategories/{id}', [SubCategoriesController::class, 'subCategoryUpdate'])->name('subcategory.update');
    Route::delete('/subcategories/{id}', [SubCategoriesController::class, 'subCategoryDelete'])->name('subcategory.delete');

});



