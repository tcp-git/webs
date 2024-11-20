<?php

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ConferenceController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SendmailController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\UserController;

Route::get('/hi', function () {
    return response()->json(['message' => 'Hi there are one !']);
});


Route::get('/user', function (Request $request) {
    return $request->user()->roles();
})->middleware('auth:api');


Route::get('/permission', function(Request $request){
    $permission = Permission::all();
    $object = [];
    foreach($permission as $value)
    {
        $object[$value->name] = $value->description;
    }
    return json_decode(json_encode($object), FALSE);
});


Route::prefix('admin')->group(function(){
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
});

Route::prefix('admin-api')->group(function(){
    Route::middleware(['auth:api'])->group(function () {

        Route::prefix('organization')->group(function(){
            Route::get('/', [OrganizationController::class, 'index'])->middleware(['scope:Read-Organization']);
            Route::get('/{id}', [OrganizationController::class, 'show'])->middleware(['scope:Read-Organization']);
            Route::get('/{id}/services', [OrganizationController::class, 'showServices'])->middleware(['scope:Read-Organization']);
            Route::post('/', [OrganizationController::class, 'store'])->middleware(['scope:Insert-Organization']);
            Route::put('/{id}', [OrganizationController::class, 'update'])->middleware(['scope:Update-Organization']);
            Route::delete('/{id}', [OrganizationController::class, 'destroy'])->middleware(['scope:Delete-Organization']);
        });

        Route::prefix('services')->group(function(){
            Route::get('/{id}', [ServiceController::class, 'show'])->middleware(['scope:Read-Services']);
            Route::get('/{id}/rooms', [ServiceController::class, 'showRoom'])->middleware(['scope:Read-Services']);
            Route::get('/{key}/key', [ServiceController::class, 'getKey']);
            Route::post('/', [ServiceController::class, 'store'])->middleware(['scope:Insert-Services']);
            Route::put('/{id}', [ServiceController::class, 'update'])->middleware(['scope:Update-Services']);
            Route::delete('/{id}', [ServiceController::class, 'destroy'])->middleware(['scope:Delete-Services']);
        });

        Route::prefix('rooms')->group(function () {
            Route::get('/{id}', [RoomController::class, 'show']);
            Route::get('/{id}/members', [RoomController::class, 'showMembers']);
            Route::post('/', [RoomController::class, 'store']);
            Route::put('/{id}', [RoomController::class, 'update']);
            Route::delete('/{id}', [RoomController::class, 'destroy']);
        });

        Route::prefix('conferences')->group(function () {
            Route::get('/{id}', [ConferenceController::class, 'show']);
            Route::get('/{id}/members', [ConferenceController::class, 'showMember']);
            Route::post('/', [ConferenceController::class, 'store']);
            Route::put('/{id}', [ConferenceController::class, 'update']);
            Route::delete('/{id}', [ConferenceController::class, 'destroy']);
        });

        Route::prefix('members')->group(function(){
            Route::get('/', [MemberController::class, 'index']);
            Route::post('/', [MemberController::class, 'store']);
            Route::get('/{id}', [MemberController::class, 'show']);
            Route::put('/{id}', [MemberController::class, 'update']);
            Route::delete('/{id}', [MemberController::class, 'destroy']);
        });

        Route::prefix('users')->group(function(){
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });


        Route::prefix('roles')->group(function(){
            Route::get('/', [RoleController::class, 'index']);
            Route::get('/{id}', [RoleController::class, 'show']);
            Route::post('/', [RoleController::class, 'store']);
        });


        Route::prefix('email')->group(function(){
            Route::get('/{email}', [SendmailController::class, 'sendEmailbyEmail']);
        });
    });
});

Route::get('sendmail', [SendmailController::class,'sendEmail']);
