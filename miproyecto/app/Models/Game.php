<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\GameResultEnum; 

class Game extends Model
{

    use HasFactory;
    public function ticketLines(){
        return $this->hasMany('App\Models\TicketLine'); 
    }

    public function resultado(){
        if(!$this->played){
            return GameResultEnum::PENDIENTE; 
        }
        if($this->golesLocal > $this->golesVisitante){
            return GameResultEnum::LOCAL; 
        }
        if($this->golesLocal < $this->golesVisitante){
            return GameResultEnum::VISITANTE;
        }
        if($this->golesLocal == $this->golesVisitante){
            return GameResultEnum::EMPATE; 
        }
    }

    public function getTitle(){
        return $this->equipo1 . " - " . $this->equipo2; 
    }
}
//