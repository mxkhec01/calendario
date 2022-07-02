<?php

use App\Http\Controllers\Auth\LoginController;


Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
});




Route::post('/login', [LoginController::class,'login'] );
