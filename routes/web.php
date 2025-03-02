<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Models\User;

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

Route::get('/', [CustomerController::class, 'index'])->name('index');

Route::get('/login',[CustomerController::class, 'login'])->name('login');
Route::post('/loginto',[CustomerController::class, 'loginto'])->name('loginto');

Route::get('/register',[CustomerController::class, 'register'])->name('register');
Route::get('/registerto',[CustomerController::class, 'registerto'])->name('registerto');

Route::get('/store',[CustomerController::class, 'store'])->name('Customer.store');

Route::any('/emailcheck',[CustomerController::class, 'emailcheck'])->name('emailcheck');

Route::get('/edit/{id}',function ($id) {
    $user=User::find($id);
    return view('edit', ['user' => $user]);
})->name('edit');

Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
Route::post('/editSave/{id}', [CustomerController::class, 'editSave'])->name('editSave');


Route::get('/dashboard', function () {
    return view('dashboard');  
})->middleware('auth')->name('dashboard');

Route::get('/dashbord/{id}', function ($id) {
    $user=User::find($id);
    return view('dashboard', ['user' => $user]);
});
// Route::get('/back/{id}', function ($id) {
//     $user=User::find($id);
//     return view('dashboard', ['user' => $user]);
// })->name('back');