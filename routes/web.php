<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\QRDetailsController;
use App\Http\Controllers\FoodDetailController;
use App\Http\Controllers\MenuDetailsController;
use App\Http\Controllers\CustomerMenuController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('customer', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customer_create', [CustomerController::class, 'create']);
    Route::post('customer_create', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customer_edit-{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('customer_edit-{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('customer/active/{id}', [CustomerController::class, 'active'])->name('customer.active');
    Route::get('customer/inactive/{id}', [CustomerController::class, 'inactive'])->name('customer.inactive');
    Route::get('customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.delete');

    Route::get('menu_details', [MenuDetailsController::class, 'index'])->name('menu_details.index');
    Route::post('menu_details', [MenuDetailsController::class, 'store'])->name('menu_details.store');
    Route::get('menu_details_show/{id}', [MenuDetailsController::class, 'show'])->name('menu_details.show');
    Route::get('menu_details_edit/{customer_id}', [MenuDetailsController::class, 'edit'])->name('menu_details.edit');
    Route::post('menu_details_update/{customer_id}', [MenuDetailsController::class, 'update'])->name('menu_details.update');
    Route::post('menu-details_currency/{id}', [MenuDetailsController::class, 'currency'])->name('menu_details.currency');
    Route::get('menu-details_delete/{id}',[MenuDetailsController::class, 'destroy'])->name('menu_details.destroy');
    Route::post('menu-details_edit_item/{id}',[MenuDetailsController::class, 'updateItem'])->name('menu_details.edit.item');
    Route::post('import_excel', [MenuDetailsController::class, 'importExcel'])->name('menu_details.import');
    Route::get('export_excel', [MenuDetailsController::class, 'exportExcel'])->name('menu_details.exportExcel');
    Route::get('deleteAll', [MenuDetailsController::class, 'destroyAll'])->name('menu_details.deleteAll');

    Route::get('category_details', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('category_details_create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('category_details', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('category_details_edit-{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('category_details_edit-{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('category/deactivate/{id}', [CategoryController::class, 'deactivate'])->name('categories.deactivate');

    Route::get('cuisine', [CuisineController::class, 'index'])->name('cuisines.index');
    Route::get('cuisine_create', [CuisineController::class, 'create']);
    Route::post('cuisine_create', [CuisineController::class, 'store'])->name('cuisines.store');
    Route::get('cuisine_edit-{cuisine}', [CuisineController::class, 'edit'])->name('cuisines.edit');
    Route::post('cuisine_edit-{id}', [CuisineController::class, 'update'])->name('cuisines.update');
    Route::get('cuisine/deactivate/{id}', [CuisineController::class, 'deactivate'])->name('cuisines.deactivate');

	Route::get('qr_code_detail', [QRDetailsController::class, 'index'])->name('qr_code_details.index');

    Route::get('qr_code_detail/edit/{id}', [QRDetailsController::class, 'edit'])->name('qr_code_details.edit');
    Route::post('qr_code_detail/update/{id}', [QRDetailsController::class, 'update'])->name('qr_code_details.update');
    Route::post('generate_qr_code/generate', [QRDetailsController::class, 'generate'])->name('generate_qr_code');
    Route::post('upload_logo', [QRDetailsController::class, 'upload'])->name('upload_logo');

    Route::get('food_details', [FoodDetailController::class, 'index']);
    Route::get('food_menu', [FoodMenuController::class, 'index']);

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
Route::get('/{customer_slug}', [CustomerMenuController::class, 'index'])->name('customer_slug');
Route::get('/{customer_slug}/{menu_details_id}', [CustomerMenuController::class, 'index'])->name('customer_menu_details');
