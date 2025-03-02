<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
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
// Route::get('/', function () {
//    return view('welcome');
//  });
Route::get('/', [
  'uses' => 'TransactionController@Index',
   'as' => 'transact.index',
  //  'middleware' => 'auth'
]);

 // option 1
  // Route::resource('customer', 'CustomerController');
  // Route::post('/customer/import', 'CustomerController@import')->name('customer-import');
// option 2

  // Route::get('/Admin/create','PetController@create')->name('admin.create');
  // Route::post('/Admin/store','PetController@store')->name('admin.store');

// Route::resource('employee', 'EmployeeController');
Route::post('/employee/import', 'EmployeeController@import')->name('employee-import');

// Routes for all authenticated users (admin & employee)
Route::middleware(['auth', 'role:admin,employee,customer'])->group(function () {
    Route::get('/Customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
    Route::put('/Customer/update/{id}', ['uses' => 'CustomerController@update', 'as' => 'customer.update']);
    Route::post('/customer/import', 'CustomerController@import')->name('customer-import');
});

// Routes restricted to only authenticated admins
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/Customer/delete/{id}', ['uses' => 'CustomerController@destroy', 'as' => 'customer.destroy']);
    Route::get('/customer/restore/{id}', ['uses' => 'CustomerController@restore', 'as' => 'customer.restore']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get('/Employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
  Route::put('/Employee/update/{id}',['uses' => 'EmployeeController@update','as' => 'employee.update']);
  Route::delete('/Employee/delete/{id}',['uses' => 'EmployeeController@destroy','as' => 'employee.destroy']);
});

Route::middleware(['auth', 'role:admin,employee'])->group(function () {
    Route::get('/Grooming/create', 'GroomingServiceController@create')->name('grooming.create');
    Route::post('/Grooming/store', 'GroomingServiceController@store')->name('grooming.store');
    Route::get('/Grooming/edit/{id}', 'GroomingServiceController@edit')->name('grooming.edit');
    Route::put('/Grooming/update/{id}', ['uses' => 'GroomingServiceController@update', 'as' => 'grooming.update']);
    Route::post('/Grooming/import', 'GroomingServiceController@import')->name('grooming-import');
});

// Restrict delete to only authenticated admins
Route::delete('/Grooming/delete/{id}', ['uses' => 'GroomingServiceController@destroy', 'as' => 'grooming.destroy'])
    ->middleware(['auth', 'role:admin']);


Route::middleware(['auth'])->group(function () {
    Route::get('/Pet/create', 'PetController@create')->name('pet.create');
    Route::post('/Pet/store', 'PetController@store')->name('pet.store');
    Route::get('/Pet/edit/{id}', 'PetController@edit')->name('pet.edit')->middleware('role:admin,employee');
    Route::put('/Pet/update/{id}', 'PetController@update')->name('pet.update');
    Route::delete('/Pet/delete/{id}', 'PetController@destroy')->name('pet.destroy')->middleware('role:admin');
    Route::post('/Pet/import', 'PetController@import')->name('pet-import');
});


// Routes restricted to only authenticated admins and employees
Route::middleware(['auth', 'role:admin,employee'])->group(function () {
    Route::get('/Consult/create', 'ConsultationController@create')->name('consult.create');
    Route::post('/Consult/store', 'ConsultationController@store')->name('consult.store');
    Route::get('/Consult/edit/{id}', 'ConsultationController@edit')->name('consult.edit');
    Route::put('/Consult/update/{id}', ['uses' => 'ConsultationController@update', 'as' => 'consult.update']);
    Route::delete('/Consult/delete/{id}', ['uses' => 'ConsultationController@destroy', 'as' => 'consult.destroy']);
});


Route::middleware(['auth', 'role:admin,employee'])->group(function () {
    Route::get('/Transact/edit/{id}', 'TransactionController@edit')->name('transacts.edit');
    Route::put('/Transact/update/{id}', ['uses' => 'TransactionController@update', 'as' => 'transacts.update']);
    Route::delete('/Transact/delete/{id}', ['uses' => 'TransactionController@destroy', 'as' => 'transacts.destroy']);
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/Chart/groom', 'GroomedchartController@index')->name('chart.groomed');
    Route::get('/Chart/date', 'GroomedchartController@date')->name('chart.date');
    Route::get('/Chart/show', 'GroomedchartController@showdate')->name('chart.show');
    Route::get('/Chart/pett', 'DiseaseschartController@index')->name('chart.pett');
});

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

Route::get('/Search/pet','SearchController@searchPet')->name('search.pet');
Route::get('/Search/petQuery','SearchController@searchPetQuery')->name('search.petquery');
Route::get('/Search/petshow/{id}','SearchController@searchPetQueryShow')->name('search.petshow');

Route::get('/Search/customer','SearchController@searchcustomer')->name('search.customer');
Route::get('/Search/customerQuery','SearchController@searchcustomerQuery')->name('search.customerquery');
Route::get('/Search/customershow/{id}','SearchController@searchcustomerQueryShow')->name('search.customershow');

Route::get('/Comment/pet','CommentController@index')->name('comment.pet');
Route::get('/Comment/pets/{id}','CommentController@comment')->name('comment.petid');
Route::get('/Comment/request','CommentController@req')->name('comment.req');

Route::group(['prefix' => 'user'], function () {
    
    // Guest Routes (Only for Unauthenticated Users)
    Route::middleware('guest')->group(function () {
        Route::get('signup', 'UserController@getSignup')->name('user.signup');
        Route::post('signup', 'UserController@postSignup');

        Route::get('signin', 'UserController@getSignin')->name('user.signin');
        Route::post('signin', 'LoginController@postSignin');

        Route::get('esignup', 'UserController@getEsignup')->name('user.esignup');
        Route::post('esignup', 'UserController@postEsignup');

        Route::get('asignup', 'UserController@getAsignup')->name('user.asignup');
        Route::post('asignup', 'UserController@postAdminSignup');
    });

    // Authenticated Routes (Only for Specific Roles)
    Route::middleware(['auth', 'role:customer'])->group(function () {
        Route::get('profile', 'UserController@getProfile')->name('user.profile'); // Only for Customers
    });

    Route::middleware(['auth', 'role:employee'])->group(function () {
        Route::get('eprofile', 'UserController@getEprofile')->name('user.eprofile'); // Only for Employees
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('aprofile', 'UserController@getAprofile')->name('user.aprofile'); // Only for Admins
    });

});


// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    
    // Admin & Employee Routes
    Route::middleware(['role:admin,employee'])->group(function () {
        Route::get('/customers', 'CustomerController@getCustomers')->name('getCustomers');
        Route::get('/pets', 'PetController@getPets')->name('getPets');
        Route::get('/consults', 'ConsultationController@getConsults')->name('getConsults');
    });

    // Admin-only Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/employees', 'EmployeeController@getEmployees')->name('getEmployees');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    });

    // Employee & Admin Routes (for Grooming)
    Route::middleware(['role:employee,admin'])->group(function () {
        Route::get('/grooming', 'GroomingServiceController@getGroomingServices')->name('getGroomingServices');
    });

    // Transactions (Accessible to Authenticated Users)
    Route::get('/transacts', 'TransactionController@getTransacts')->name('getTransacts');

    // Shopping Cart & Checkout
    Route::get('add-to-cart/{id}', 'TransactionController@getAddToCart')->name('service.addToCart');
    Route::get('shopping-cart', 'TransactionController@getCart')->name('service.shoppingCart');
    Route::get('remove/{id}', 'TransactionController@getRemoveItem')->name('service.remove');

    Route::post('checkout', 'TransactionController@storeCheckout')
        ->name('service.checkout')
        ->middleware('role:admin,customer');

    // Logout
    Route::get('logout', 'LoginController@logout')->name('user.logout');
});

    Route::fallback(function () {
        return redirect()->back();
});


