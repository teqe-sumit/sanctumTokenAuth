<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Public Routes
Route::post('/register', [UserController::class, 'register']);   // register user
Route::post('/login', [UserController::class, 'login']);                           // login user

Route::get('/posts/{id}', [PostController::class, 'show']);                //single post



// Protected Routesphp artisan migrate


Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [UserController::class, 'logout']);      // log me out 
    Route::get('/loggeduser', [UserController::class, 'logged_user']);      // details of logged in user
   
   
    Route::post('/posts', [PostController::class, 'store']);  // new post
    Route::put('/posts/{id}', [PostController::class, 'update']);         //update post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); //destroy post

    Route::get('/posts', [PostController::class, 'index']);       //all post




});