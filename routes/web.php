<?php

use App\Services\DiagFlowAuthService;
use Illuminate\Support\Facades\Route;

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
    $a = new DiagFlowAuthService;

    $c = env('GOOGLE_APPLICATION_CREDENTIALS');
    //dd($c);
    $tes = $a->createIntent();

    dd($tes);
});