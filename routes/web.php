<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\backend\admin\categories\CategoriesController;
use App\Http\Controllers\backend\admin\categories\ChildCategoriesController;
use App\Http\Controllers\backend\admin\categories\SubCategoriesController;
use App\Http\Controllers\backend\admin\customers\Customers_Controller;
use App\Http\Controllers\backend\admin\DashboardController;
use App\Http\Controllers\backend\admin\orders\OrdersController;
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
Route::get('/productsublist/{slug}', [ProductController::class,'productSub_list'])->name('frontend.product.sub_list');
Route::get('/product_list/{slug}', [ProductController::class, 'productList'])->name('frontend.product.products_list');
Route::get('/product_list_child/{slug}', [ProductController::class, 'productListChild'])->name('frontend.product.products_list_child');
Route::get('/product/{slug}', [ProductController::class, 'productShow'])->name('frontend.product.show');

//Cart releted routes.
// Route::get('/cart/quantity', [CartController::class, 'cartCount'])->name('cart.quantity');
Route::get('/cart', [CartController::class, 'cartIndex'])->name('cart.index');
Route::post('/cart', [CartController::class, 'cartStore'])->name('cart.store');
Route::post('/cart/destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');
Route::get('/cart/clear', [CartController::class, 'cartClear'])->name('cart.clear');
Route::get('/checkout', [CartController::class,'checkout'])->name('checkout');
Route::post('/change/qty', [CartController::class, 'changeQty'])->name('change.qty');

Route::post('/buy_now/{id}', [CartController::class, 'buy_now'])->name('buy_now');

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

Route::name('admin.')->prefix('admin')->middleware(['auth','isAdmin'])->group(function () {

    // Deshboard 

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products 
    Route::get('/products', [ProductsController::class, 'products'])->name('products');
    Route::get('/products/new', [ProductsController::class, 'productsNew'])->name('products.new');
    Route::post('/products', [ProductsController::class, 'productsStore']);
    Route::get('/products/{id}', [ProductsController::class, 'productsShow'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductsController::class, 'productsEdit'])->name('products.edit');
    Route::put('/products/{id}', [ProductsController::class, 'productsUpdate'])->name('products.update');
    Route::delete('/products/{id}', [ProductsController::class, 'productsDelete'])->name('products.delete');

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
    Route::post('/subcategories', [SubCategoriesController::class, 'storeSubCategories']);
    Route::get('/subcategories/{id}', [SubCategoriesController::class, 'showSubCategory'])->name('subcategory.show');
    Route::get('/subcategories/{id}/edit', [SubCategoriesController::class, 'subCategoryEdit'])->name('subcategory.edit');
    Route::put('/subcategories/{id}', [SubCategoriesController::class, 'subCategoryUpdate'])->name('subcategory.update');
    Route::delete('/subcategories/{id}', [SubCategoriesController::class, 'subCategoryDelete'])->name('subcategory.delete');


    //Child Category
    Route::get('/childcategories', [ChildCategoriesController::class, 'childCategories'])->name('childcategories');
    Route::get('/childcategories/new', [ChildCategoriesController::class, 'newChildCategory'])->name('childcategory.new');
    Route::post('/childcategories', [ChildCategoriesController::class, 'storeChildCategories']);
    Route::get('/childcategories/{id}', [ChildCategoriesController::class, 'showChildCategory'])->name('childcategory.show');
    Route::get('/childcategories/{id}/edit', [ChildCategoriesController::class, 'childCategoryEdit'])->name('childcategory.edit');
    Route::put('/childcategories/{id}', [ChildCategoriesController::class, 'childCategoryUpdate'])->name('childcategory.update');
    Route::delete('/childcategories/{id}', [ChildCategoriesController::class, 'childCategoryDelete'])->name('childcategory.delete');


    //Customers
    Route::get('/customers', [Customers_Controller::class, 'customers'])->name('customers');

    //Orders
    Route::get('/orders', [OrdersController::class, 'orders'])->name('orders');
    Route::get('/order/new', [OrdersController::class, 'newOrder'])->name('order.new');
    Route::post('/orders', [OrdersController::class, 'orderStore']);
    Route::get('/order/{id}', [OrdersController::class, 'orderShow'])->name('order.show');
    Route::get('/order/{id}/edit', [OrdersController::class, 'orderEdit'])->name('order.edit');
    Route::put('/order/{id}', [OrdersController::class, 'orderUpdate'])->name('order.update');
    Route::delete('/order/{id}', [OrdersController::class, 'orderDelete'])->name('order.delete');



});



