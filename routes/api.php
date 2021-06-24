<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->group(function () {
    Route::get('/books', [BookController::class, 'get']);

    // added it according to the docs
    // but we could use the /get?filter[id] instead
    Route::get('/books/{id}', [BookController::class, 'getById']);
});