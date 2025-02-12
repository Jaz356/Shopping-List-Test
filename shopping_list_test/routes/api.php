<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingListController;

Route::get('/shopping-lists', [ShoppingListController::class, 'index']);
Route::post('/shopping-lists', [ShoppingListController::class, 'store']);
Route::get('/shopping-lists/{id}', [ShoppingListController::class, 'show']);
Route::put('/shopping-lists/{id}', [ShoppingListController::class, 'update']);
Route::delete('/shopping-lists/{id}', [ShoppingListController::class, 'destroy']);
Route::delete('/shopping-lists', [ShoppingListController::class, 'destroyAll']);
