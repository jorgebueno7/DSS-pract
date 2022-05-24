<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Cookie; 
use App\Models\TicketLine; 
use App\ServiceLayer\TicketServices; 
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('inicio');
    }

    public function matches(){
        $games = Game::where('played', 'false')->paginate(15); 
        $ck = Cookie::get('ticket'); 
        $myTicket = []; 
        $multiplicador = 0; 
        if($ck != null){
            $array = json_decode(Cookie::get('ticket')); 


            foreach ($array as $a){
                $matchId = $a[0];
                $resultado = $a[1]; 
                $cuota = $a[2]; 
                if($multiplicador == 0) $multiplicador = $cuota; 
                else $multiplicador = $cuota * $multiplicador; 

                $tl = new TicketLine(); 
                $tl->cuotaElegida = $cuota; 
                $tl->game_id = $matchId; 
                $tl->resultado = $resultado; 

                array_push($myTicket, $tl); 

            }
        }
        
        $multiplicador = round($multiplicador, 2); 
        return view('matches', ['games' => $games, 'myticket' => $myTicket, 'mult' => $multiplicador]); 
    }

    public function createTicketUser(Request $request){
        $request->validate([
            'dineroApostado' => 'required|gte:1',
        ]);
        if(!Auth::check()){
            return redirect()->back()->withErrors(['msg' => 'Debes iniciar sesión antes de apostar']);
        }
        $cookie = Cookie::get('ticket');
        $cookie = json_decode($cookie, true); 
        if($cookie == null || empty($cookie)){
            return redirect()->back()->withErrors(['msg' =>  'Debes seleccionar más de un partido']);
        }

        $user = Auth::user(); 
        $res = TicketServices::createTicket($cookie, $request->dineroApostado, $user); 


        
        if($res == null){
            return redirect()->back()->withErrors(['msg' => 'No tienes suficiente saldo']);        
        }
        if($request->cookieSave == "1"){
            return redirect()->back()->with('success', 'Creado tu cupon correctamente'); 
        }
        return redirect()->back()->withCookie(Cookie::forget('ticket'))->with('success', 'Creado tu cupon correctamente'); 

    }



}
