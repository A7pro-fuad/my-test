<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



// Route::get('posts',[PostController::class,'index']);
Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
        Route::post('posts/{post}/media/upload', [PostController::class, 'upload']);
        Route::apiResource('posts', PostController::class);

        Route::post('posts/{post}', [PostController::class, 'toggleLike'])->name('posts.toggleLike');

        Route::get('categories', [CategoryController::class, 'index']);

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::get('abilities', function (Request $request) {
            return $request->user()->roles()->with('permissions')
                ->get()
                ->pluck('permissions')
                ->flatten()
                ->pluck('name')
                ->unique()
                ->values()
                ->toArray();
        });
    }
);
