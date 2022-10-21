<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Notes\NoteDestroyController;
use App\Http\Controllers\Notes\NoteListController;
use App\Http\Controllers\Notes\NoteShowController;
use App\Http\Controllers\Notes\NoteStoreController;
use App\Http\Controllers\Notes\NoteUpdateController;
use Illuminate\Support\Facades\Route;




Route::group(['prefix' => 'note/', ], function () {
    // Routes generated for Notes
    Route::get('list', [NoteListController::class, '__invoke']);
    Route::get('show/{note:id}', [NoteShowController::class, '__invoke']);
    Route::post('store', [NoteStoreController::class, '__invoke']);
    Route::put('update/{note:id}', [NoteUpdateController::class, '__invoke']);
    Route::delete('destroy/{note:id}', [NoteDestroyController::class, '__invoke']);
});
