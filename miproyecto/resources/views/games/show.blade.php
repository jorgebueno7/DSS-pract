@extends('layout')


@section('title', 'Partidos')

@section('content')

    <div class="p-3">
        <form  method="POST" action="{{ route('games-update', ['id' => $game->id]) }}">
        @method('PATCH')    
        @csrf

            <div class="mb-3 col">
                
            @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
            <h6 class="alert alert-danger">{{ $error }}</h6>

            @endforeach
            
            @endif


            @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

                <label for="title" class="form-label">Cuota1 </label>
                <input type="number" step="0.01" class="form-control mb-2" name="cuota1" id="cuota1" placeholder="valor cuota1" value="{{ $game->cuota1 }}">

                <label for="title" class="form-label">Cuota2 </label>
                <input type="number" step="0.01" class="form-control mb-2" name="cuota2" id="cuota2" placeholder="valor cuota2" value="{{ $game->cuota2 }}">

                <label for="title" class="form-label">CuotaX </label>
                <input type="number" step="0.01" class="form-control mb-2" name="cuotaX" id="cuota2" placeholder="valor cuotaX" value="{{ $game->cuotaX }}">


                <label for="title" class="form-label">Equipo1 </label>
                <input type="text" step="0.01" class="form-control mb-2" name="equipo1" id="equipo1" placeholder="equipo1" value="{{ $game->equipo1 }}">

                <label for="title" class="form-label">Equipo2 </label>
                <input type="text" step="0.01" class="form-control mb-2" name="equipo2" id="equipo2" placeholder="equipo2" value="{{ $game->equipo2 }}">
                
                <label for="title" class="form-label">Goles del Local </label>
                <input type="number" step="0.01" class="form-control mb-2" name="golesLocal" id="golesLocal" placeholder="golesLocal" value="{{ $game->golesLocal }}">

                <label for="title" class="form-label">Goles Visitante </label>
                <input type="number" step="0.01" class="form-control mb-2" name="golesVisitante" id="equipo1" placeholder="golesVisitante" value="{{ $game->golesVisitante }}">

                <div class="form-check">
                @if(!$game->played )
                <input class="form-check-input" type="checkbox" name="gamePlayed" value="1" id="gamePlayed">
                @endif
                <label class="form-check-label" for="gamePlayed">
                    Partido finalizado
                </label>
                </div>
        
                <input type="submit" value="Actualizar" class="btn btn-success my-2" />
            </div>
        </form>
        <div class="d-flex flex-row-reverse">
                <form action="{{ route('games-index') }}">
                    <input type="submit" value="Volver" class="btn btn-primary my-2" /></div>
            </form>
            
    </div>


@endsection