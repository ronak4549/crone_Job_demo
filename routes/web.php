<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/send-test-email', function () {
    Mail::to('ronak.prajapati@atozinfoway.com')->send(new TestEmail());
    return 'Test email sent!';
});

Route::get('testQuery', function () {
    $user = User::where('email', 'ronak.prajapati@atozinfoway.com')->toSql();
    return $user;
});