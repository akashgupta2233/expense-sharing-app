<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/create-group', [HomeController::class, 'createGroup'])->name('create.group');
Route::post('/add-user', [HomeController::class, 'addUser'])->name('add.user');
Route::post('/delete-user/{id}', [HomeController::class, 'deleteUser'])->name('delete.user');
Route::post('/reset', [HomeController::class, 'reset'])->name('reset.all');
Route::post('/add-expense', [HomeController::class, 'addExpense'])->name('add.expense');
Route::post('/split-expense', [HomeController::class, 'splitExpense'])->name('split.expense');
Route::post('/clear-expenses', [HomeController::class, 'clearExpenses'])->name('clear.expenses');
