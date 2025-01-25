<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\lawyerController;

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

// //URL:http://127.0.0.1:8000/
// Route::get('/', function () {
//     return view('welcome');
// });

//URL:http://127.0.0.1:8000
Route::get('/', [clientController::class, 'home']);

//URL:http://127.0.0.1:8000/uhome
Route::get('/uhome', [clientController::class, 'uhome']);

//URL:http://127.0.0.1:8000/uabout
Route::get('/uabout', [clientController::class, 'uabout']);

//URL:http://127.0.0.1:8000/uannoucement
Route::get('/uannoucement', [clientController::class, 'uannoucement']);

//URL:http://127.0.0.1:8000/ucontact
Route::get('/ucontact', [clientController::class, 'ucontact']);

//URL:http://127.0.0.1:8000/lawhome
Route::get('/lawhome', [lawyerController::class, 'lawhome']);//lawhome.blade,php

//URL:http://127.0.0.1:8000/lawabout
Route::get('/lawabout', [lawyerController::class, 'lawabout']);//lawabout.blade,php

//URL:http://127.0.0.1:8000/lawannoucement
Route::get('/lawannoucement', [lawyerController::class, 'lawannoucement']);//lawannoucement.blade,php

//URL:http://127.0.0.1:8000/lawcontact
Route::get('/lawcontact', [lawyerController::class, 'lawcontact']);//lawcontact.blade,php

Route::get('/profile', [clientController::class, 'profile']); //profile.blade.php

Route::get('/dashboard', [lawyerController::class, 'dashboard']); //dashboard.blade.php

//URL:http://127.0.0.1:8000/about
Route::get('/about', function () {
    return view('about'); //about.blade.php
});

//URL:http://127.0.0.1:8000/people
Route::get('/people', function () {
    return view('people'); //people.blade.php
});

//URL:http://127.0.0.1:8000/annoucement
Route::get('/annoucement', function () {
    return view('annoucement'); //annoucement.blade.php
});

//URL:http://127.0.0.1:8000/contact
Route::get('/contact', function () {
    return view('contact'); //contact.blade.php
});

//URL:http://127.0.0.1:8000/signin
Route::get('/signin', [clientController::class, 'signin']);

//URL:http://127.0.0.1:8000/register_client
Route::get('/register_client', [clientController::class, 'register_client']);
Route::post('/registerClient', [clientController::class, 'registerClient'])->name('registerClient');
Route::post('/loginClient', [clientController::class, 'loginClient'])->name('loginClient');

Route::get('/logout', [clientController::class, 'logout']);
Route::get('/logout', [lawyerController::class, 'logout']);

Route::get('/clientEdit/{id}', [clientController::class, 'clientEdit']); //clientEdit.blade.php
Route::post('/update', [clientController::class, 'update'])->name('update');

Route::get('/lawyeredit/{id}', [lawyerController::class, 'lawyeredit']); 
Route::post('/update1', [lawyerController::class, 'update1'])->name('update1');

Route::get('/signinLawyer', [lawyerController::class, 'signinLawyer']);//signinLawyer.blade.php

Route::get('/register_lawyer', [lawyerController::class, 'register_lawyer']);

Route::post('/registerLawyer', [lawyerController::class, 'registerLawyer'])->name('registerLawyer');

Route::post('/loginLawyer', [lawyerController::class, 'loginLawyer'])->name('loginLawyer');

//URL:http://127.0.0.1:8000/expertise1_lawyer
Route::get('/expertise1', function () {
    return view('expertise1'); //expertise1.blade.php
});

//URL:http://127.0.0.1:8000/lawyershow
Route::get('/lawyershow', [lawyerController::class, 'lawyershow']);

//URL:http://127.0.0.1:8000/lawyeredit
Route::get('/lawyeredit', function () {
    return view('lawyeredit'); //lawyeredit.blade.php
});
