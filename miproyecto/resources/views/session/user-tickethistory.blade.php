@extends('layout')


@section('title', 'Recargar saldo')

@section('content')

@error('title')
                <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

        <div class="p-3 bg-white mb-10">

        <h1>Tickets</h1>
        <div id="accordion">
            @foreach ($tickets as $ticket)
            <div class="card">
                <div class="card-header" id="heading">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $ticket->id }}" aria-expanded="false" aria-controls="collapseOne">
                    Ticket #{{ $ticket->id }} 
                    
                    </button>
             
                </h5>
                <b>Premio: </b> {{ $ticket->getPremio() }}
                @if($ticket->status()->value == 'PENDIENTE')
                <p class="text-right text-primary">{{ $ticket->status()->value }}</p>
                @endif
                @if($ticket->status()->value == 'GANADO')
                <p class="text-right text-success">{{ $ticket->status()->value }}</p>
                @endif
                @if($ticket->status()->value == 'PERDIDO')
                <p class="text-right text-danger">{{ $ticket->status()->value }}</p>
                @endif


                </div>

                <div id="collapse{{ $ticket->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                    @foreach ($ticket->ticketLines as $row)
                        
                        
                        <div class="row mt-2">

                        <div class="col-sm-8">        
                            <b> {{ $row->game->getTitle() }}</b> 
                            <div class="clearfix hidden-xs hidden-sm"> </div>
                            Resultado: {{ $row->resultado}}
                            @if($row->status()->value == 'PENDIENTE')
                            <p class="text-primary">{{ $row->status()->value }}</p>
                            @endif
                            @if($row->status()->value == 'GANADO')
                            <p class="text-success">{{ $row->status()->value }}</p>
                            @endif
                            @if($row->status()->value == 'PERDIDO')
                            <p class="text-danger">{{ $row->status()->value }}</p>
                            @endif
                        </div>
                        <div class="col-sm-4">{{ $row->cuotaElegida }}</div>
                    </div>

                        @endforeach                  
                      </div>
                </div>
            </div>
            @endforeach
  
        </div>

</div> 


@endsection