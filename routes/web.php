<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create'); //deve ficar em primeiro/ rota para retornar o formulário de create
Route::any('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
Route::get('/tickets/edit/{id}', [TicketController::class, 'edit'])->name('tickets.edit');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets', [TicketController::class, 'creation'])->name('tickets.creation'); //rota para enviar o formulário
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index'); //rota para retornar a listagem de tickets

Route::get('/', function () {
    return view('welcome');
});
