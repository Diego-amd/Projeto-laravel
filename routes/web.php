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
//grupo de autentição
Route::middleware(['auth'])->group(function()
{
    Route::any('/tickets/time', [TicketController::class, 'start'])->name('tickets.start'); //rota para adicionar o tempo ao clockify
    Route::get('/tickets/statistics', [TicketController::class, 'statistics'])->name('tickets.statistics'); //rota de estatísticas do clockify
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create'); //deve ficar em primeiro/ rota para retornar o formulário de create
    Route::any('/tickets/search', [TicketController::class, 'search'])->name('tickets.search'); //rota para buscar o ticket
    Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update'); //rota para fazer o update
    Route::get('/tickets/edit/{id}', [TicketController::class, 'edit'])->name('tickets.edit'); //rota para exibir o form de edit
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy'); //rota para excluir o ticket
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show'); //rota para exibir o ticket em modo exibição
    Route::post('/tickets', [TicketController::class, 'creation'])->name('tickets.creation'); //rota para enviar o formulário
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index'); //rota para retornar a listagem de tickets
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';