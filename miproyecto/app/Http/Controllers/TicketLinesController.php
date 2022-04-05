<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketLine;

class TicketLinesController extends Controller
{
    public function store(Request $request){
        $ticketline = new TicketLine;
        $ticketline->cuotaElegida = $request->cuotaElegida;
        $ticketline->game_id = $request->game_id;
        $ticketline->ticket_id = $request->ticket_id;
        $ticketline->save();

        return redirect()->route('ticketlines-add')->with('success', 'Línea de boleto creada correctamente');
    }

    public function show($id){
        $ticketline = TicketLine::find($id);
        return view('ticketlines.show', ['ticketline' => $ticketline]);

    }
    public function index(){
        $ticketline = TicketLine::paginate(10);
        return view('ticketlines.index', ['ticketline' => $ticketline]);
    }

    public function update(Request $request, $id){
        $ticketline = TicketLine::find($id);
        $ticketline->cuotaElegida = $request->cuotaElegida;
        $ticketline->game_id = $request->game_id;
        $ticketline->ticket_id = $request->ticket_id;
        $ticketline->save();

        return redirect()->route('ticketlines-edit', ['id' => $ticketline->ticket_id])->with('succes', 'Línea de boleto actualizada correctamente');

    }

    public function destroy($id){
        $ticketline = TicketLine::find($id);
        $ticketline->delete();

        return redirect()->route('ticketlines-index')->with('succes', 'Línea de boleto eliminada correctamente');
    }
}
