<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TicketLinesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TicketsController; 
use App\Http\Controllers\CreditCardsController;  
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\CuponCookieController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');
Route::get('/bet', [HomeController::class, 'matches'])->name('bet'); 

//Route::get('/games', [GamesController::class, 'index'])->name('games');
//Route::get('/games', [GamesController::class, 'show'])->name('games');
//Route::path('/games', [GamesController::class, 'update'])->name('games-update');
//Route::delete('/games', [GamesController::class, 'delete'])->name('games-delete');
 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::post('/user/tickets', [HomeController::class, 'createTicketUser'])->name('user-ticket-create'); 

Route::group(['middleware' => 'auth'], function () {
    Route::post('/user/creditcards', [CreditCardsController::class, 'storeUserAuth'])->name('session-add-creditcard'); 
    Route::get('/user/creditcards', [CreditCardsController::class, 'showUserAuth'])->name('session-credit-cards'); 
    Route::patch('users/creditcards/{id}', [CreditCardsController::class, 'update'])->name('creditcards-update'); 
    Route::delete('/users/creditcards/{id}', [CreditCardsController::class, 'destroy'])->name('creditcards-delete'); 
    Route::post('/user/balance/add', [CreditCardsController::class, 'addUserBalance'])->name('user-add-balance'); 
    Route::post('/user/balance/withdraw', [CreditCardsController::class, 'withdrawUserBalance'])->name('user-withdraw-balance');  
    Route::get('/user/profile', [UsersController::class, 'showProfileAuth'])->name('session-profile'); 
    Route::patch('/user/profile/{id}', [UsersController::class, 'updateProfileAuth'])->name('session-profile-update'); 

    Route::get('/user/tickets', [TicketsController::class, 'showUserTickets'])->name('user-tickets-show');

}); 




Route::post('cupon', [CuponCookieController::class, 'add'])->name('ticket-cookie-store');  
Route::delete('/cupon/{matchId}', [CuponCookieController::class, 'delete'])->name('ticket-cookie-delete'); 

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/users/add', function() {return view('users.form'); })->name('users-add');
    Route::post('admin/users/add', [UsersController::class, 'store'])->name('users-store');  
    Route::get('/admin/users', [UsersController::class, 'index'])->name('users-index'); 
    Route::post('/admin/users', [UsersController::class, 'filter'])->name('users-filter');
    Route::get('/admin/users/order/{opt}', [UsersController::class, 'indexBy'])->name('users-index-order'); 
    Route::delete('/admin/users/{id}', [UsersController::class, 'destroy'])->name('users-delete'); 
    Route::get('/admin/users/{id}', [UsersController::class, 'show'])->name('users-edit'); 
    Route::patch('/admin/users/{id}', [UsersController::class, 'update'])->name('users-update'); 

    // Credit Card
    Route::post('/admin/users/{id}/creditcards/add', [CreditCardsController::class, 'store'])->name('creditcards-store'); 

    // Ticket Lines
    Route::get('/admin/ticketlines/add', function() { return view('ticketlines.form'); })->name('ticketlines-add');
    Route::post('ticketlines/add', [TicketLinesController::class, 'store'])->name('ticketlines-store');
    Route::get('/admin/ticketlines/order/{opt}', [TicketLinesController::class, 'indexBy'])->name('ticketlines-index-order'); 
    Route::get('/admin/ticketlines', [TicketLinesController::class, 'index'])->name('ticketlines-index');

    Route::delete('/admin/ticketlines/{id}', [TicketLinesController::class, 'destroy'])->name('ticketlines-delete'); 
    Route::get('/admin/ticketlines/{id}', [TicketLinesController::class, 'show'])->name('ticketlines-edit'); 
    Route::patch('/admin/ticketlines/{id}', [TicketLinesController::class, 'update'])->name('ticketlines-update'); 

    // Games
    Route::get('/admin/games/add', function() { return view('games.form'); })->name('games-add');
    Route::post('admin/games/add', [GameController::class, 'store'])->name('games-store');  
    Route::get('/admin/games', [GameController::class, 'index'])->name('games-index');
    Route::post('/admin/games', [GameController::class, 'filter'])->name('games-filter'); 
    Route::delete('/admin/games/{id}', [GameController::class, 'destroy'])->name('games-delete'); 
    Route::get('/admin/games/{id}', [GameController::class, 'show'])->name('games-edit'); 
    Route::patch('/admin/games/{id}', [GameController::class, 'update'])->name('games-update'); 
    Route::patch('/admin/ticketlines/{id}', [TicketLinesController::class, 'update'])->name('ticketlines-update');

    // Ticket
    Route::get('/admin/tickets/add', function() { return view('tickets.form'); })->name('tickets-add');
    Route::get('/admin/tickets', [TicketsController::class, 'index'])->name('tickets-index'); 
    Route::delete('/admin/tickets/{id}', [TicketsController::class, 'destroy'])->name('tickets-delete');
    Route::get('/admin/tickets/{id}', [TicketsController::class, 'show'])->name('tickets-edit');  
    Route::post('admin/tickets/add', [TicketsController::class, 'store'])->name('tickets-store');  
    Route::patch('/admin/tickets/{id}', [TicketsController::class, 'update'])->name('tickets-update');
});