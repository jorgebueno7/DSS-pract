<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\ServiceLayer\TicketServices; 
use App\Models\Game;


class GameController extends Controller{

    private function validateGame(Request $request){
        $request->validate([
            'cuota1' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'cuotaX' => 'required|regex:/^\d+(\.\d{1,2})?$/', 
            'cuota2' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'equipo1' => 'required',
            'equipo2' => 'required',
            'golesLocal' => 'required|integer',
            'golesVisitante' => 'required|integer',
        ]); 
        
    }

    public function store(Request $request){
        // validamos los datos
        $this->validateGame($request); 


        $game = new Game();
        $game->cuota1 = $request->cuota1;
        $game->cuotaX = $request->cuotaX;
        $game->cuota2 = $request->cuota2; 
        $game->equipo1 = $request->equipo1; 
        $game->equipo2 = $request->equipo2;
        $game->golesLocal = $request->golesLocal; 
        $game->golesVisitante = $request->golesVisitante; 
        if($request->gamePlayed == "1"){
            $game->played = true; 
        }

        $game->save(); 
        return redirect()->route('games-add')->with('success', 'Partido creado correctamente'); 
    }



    public function filter(Request $request){
        if($request->local == null && $request->visitante == null){
            return redirect()->route('games-index'); 
        }
        else if($request->local != null && $request->visitante == null){
            $games = Game::where('equipo1', 'LIKE', '%' . $request->local . '%')->paginate(15); 
            return view('games.index', ['games' => $games]); 
        }
        else if($request->local == null && $request->visitante != null){
            $games = Game::where('equipo2', 'LIKE', '%' . $request->visitante . '%')->paginate(15); 
            return view('games.index', ['games' => $games]); 
        }
        else{
            $games = Game::where('equipo1', 'LIKE', '%' . $request->local . '%')->where('equipo2', 'LIKE', '%' . $request->visitante . '%')->paginate(15); 
            return view('games.index', ['games' => $games]); 
        }
    }
    
    
    public function index(){
        $games = Game::paginate(10);
        return view('games.index', ['games' => $games]); 
    }

    public function show($id){
        $game = Game::findOrFail($id); 
        return view('games.show', ['game' => $game]);
    }


    public function update(Request $request, $id){
        // validamos los datos
        $request->validate([
            'cuota1' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'cuotaX' => 'required|regex:/^\d+(\.\d{1,2})?$/', 
            'cuota2' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'equipo1' => 'required',
            'equipo2' => 'required',
            'golesLocal' => 'required|integer',
            'golesVisitante' => 'required|integer'
        ]);


        $game = Game::find($id); 
        $game->cuota1 = $request->cuota1; 
        $game->cuota2 = $request->cuota2;
        $game->cuotaX = $request->cuotaX;
        $game->equipo1 = $request->equipo1;
        $game->equipo2 = $request->equipo2;
        $game->golesLocal = $request->golesLocal; 
        $game->golesVisitante = $request->golesVisitante;
        if($request->gamePlayed == "1"){
            $game->played = true; 
            $game->save(); 
            TicketServices::updateTickets($game); 
        }

        $game->save(); 
        return redirect()->route('games-edit', ['id' => $game->id])->with('success', 'Partido actualizado correctamente'); 
    }

    public function destroy(Request $request, $id){
        $game = Game::find($id);
        $game->delete(); 
        return redirect()->route('games-index')->with('success', 'Partido ' . $game->id .' eliminado correctamente');
    }

    
}