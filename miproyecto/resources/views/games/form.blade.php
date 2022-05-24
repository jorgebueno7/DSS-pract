@extends('layout')


@section('title', 'Partidos')

@section('content')

    <div class="p-3">
        <form  method="POST" action="{{ route('games-store') }}">
            @csrf

            <div class="mb-3 col">
                    {{-- Error messages --}}
            @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
            <h6 class="alert alert-danger">{{ $error }}</h6>

            @endforeach
            
            @endif


            @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

                <label for="title" class="form-label">Cuota1 </label>
                <input type="number" step="0.01" class="form-control mb-2" name="cuota1" id="cuota1" placeholder="precio cuota1">

                <label for="title" class="form-label">CuotaX </label>
                <input type="number" step="0.01" class="form-control mb-2" name="cuotaX" id="cuotaX" placeholder="precio cuotaX">

                <label for="title" class="form-label">Cuota2 </label>
                <input type="number" step="0.01"class="form-control mb-2" name="cuota2" id="cuota2" placeholder="precio cuota2">



                <label for="title" class="form-label">Equipo1 </label>
                <input type="text" step="0.01" class="form-control mb-2" name="equipo1" id="equipo1" placeholder="nombre equipo">
                
                <label for="title" class="form-label">Equipo2 </label>
                <input type="text" step="0.01" class="form-control mb-2" name="equipo2" id="equipo2" placeholder="nombre equipo">

                <label for="title" class="form-label">Goles Local </label>
                <input type="number" step="0.01" class="form-control mb-2" name="golesLocal" id="golesLocal" placeholder="goles del local">

                <label for="title" class="form-label">Goles Visitante </label>
                <input type="number" step="0.01" class="form-control mb-2" name="golesVisitante" id="golesVisitante" placeholder="goles del visitante">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="gamePlayed" value="1" id="gamePlayed">
                <label class="form-check-label" for="gamePlayed">
                    Partido finalizado
                </label>
                </div>
                
                <input type="submit" value="Crear partido" class="btn btn-primary my-2" />

                
            </div>
        </form>
                    <div class="d-flex flex-row-reverse">
                <form action="{{ route('games-index') }}">
                    <input type="submit" value="Volver" class="btn btn-primary my-2" /></div>
            </form>
            
    </div>


@endsection