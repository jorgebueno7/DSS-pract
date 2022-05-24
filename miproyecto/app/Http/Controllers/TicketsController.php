<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Controllers\TicketLinesController;
use App\Models\TicketLine;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function store(Request $request){
        
        $request->validate([
            'dineroApostado' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'user_id' => 'required|exists:users,id'
        ]); 
        
        $ticket = new Ticket();
        $ticket->dineroApostado = $request->dineroApostado;
        $ticket->user_id = $request->user_id;

        $ticket->save();    
        return redirect()->route('tickets-add')->with('success', 'Boleto añadidura correctamente'); 
    }

    public function update(Request $request, $id) {

        $request->validate([
            'dineroApostado' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'user_id' => 'required|exists:users,id'
        ]); 

        $ticket = Ticket::find($id);
        $ticket->dineroApostado = $request->dineroApostado;
        $ticket->user_id = $request->user_id;
        $ticket->save();
        return redirect()->route('tickets-edit', ['id' => $ticket->id])->with('success', 'Boleto actualizado correctamente'); 
    }

    public function destroy(Request $request, $id) {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect()->route('tickets-index')->with('succes', 'Boleto eliminado correctamente');
    }

    public function index() {
        $ticket = Ticket::paginate(10);
        return view('tickets.index', ['tickets' => $ticket]);
    }

    public function show($id) {
        $ticket = Ticket::FindOrFail($id);
        return view('tickets.show', ['ticket' => $ticket]);
    }

    public function showUserTickets(){
        $user = Auth::user(); 
        $tickets = $user->tickets->reverse();  

        return view('session.user-tickethistory', ['tickets' => $tickets]); 
    }
    
}
