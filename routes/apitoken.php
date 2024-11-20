<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APITOKEN\RoomController;
use App\Http\Controllers\APITOKEN\MemberController;
use App\Http\Middleware\EnsureTokenIsValid;


Route::middleware(EnsureTokenIsValid::class)->group(function () {
    Route::prefix('rooms')->group(function () {
        Route::get('/{id}', [RoomController::class, 'show']);
        Route::get('/{id}/members', [RoomController::class, 'showMembers']);
        Route::post('/', [RoomController::class, 'store']);
        Route::put('/{id}', [RoomController::class, 'update']);
        Route::delete('/{id}', [RoomController::class, 'destroy']);
    });

    Route::prefix('members')->group(function(){
        Route::get('/', [MemberController::class, 'index']);
        Route::post('/', [MemberController::class, 'store']);
        Route::get('/{id}', [MemberController::class, 'show']);
        Route::put('/{id}', [MemberController::class, 'update']);
        Route::delete('/{id}', [MemberController::class, 'destroy']);
    });

});
