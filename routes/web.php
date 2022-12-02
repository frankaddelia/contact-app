<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', WelcomeController::class);

Route::controller(ContactController::class)->group(function () {
    Route::get('/contacts', 'index')->name('contacts.index');

    Route::get('/contacts/create', 'create')->name('contacts.create');

    Route::get('/contacts/{id}', 'show')->whereNumber('id')->name('contacts.show');
});


Route::get('/companies/{name?}', function ($name = null) {
    if ($name) {
        return "<h1>Company $name</h1>";
    }

    return "<h1>All companies</h1>";
})->whereAlpha('name');

Route::fallback(function () {
    return "<h1>Sorry, this page does not exist</h1>";
});

Route::resource('/companies', CompanyController::class);

Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
]);

// Route::resource('/activities', ActivityController::class)->only([
//     'create', 'store', 'edit', 'update', 'destroy'
// ]);

// Route::resource('/activities', ActivityController::class)->names([
//     'index' => 'activities.all',
//     'show' => 'activities.view'
// ]);
Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active'
]);

Route::resource('/contacts.notes', ContactNoteController::class);
