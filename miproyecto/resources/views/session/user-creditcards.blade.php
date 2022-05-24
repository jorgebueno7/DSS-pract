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
            <b><h3>Añadir saldo</h3></b>
            <div class="form-group">
            <form  method="POST" action="{{ route('user-add-balance') }}">
                @csrf
        <input type="number" id="dineroDepositar" name="dineroDepositar" min="5" step=".01" class="form-control" placeholder="Euros" aria-label="Euros" aria-describedby="basic-addon1">

    <small class="form-text text-muted">La cantidad minima son 5 euros</small>
  </div>

            <select name="creditcard" class="form-control">
            @foreach($user->creditCards as $cc)
                <option value="{{ $cc->id }} ">{{ $cc->num }} </option>
            @endforeach
            </select>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Añadir saldo</button>
            </div>
            </form>
        </div>

</div> 

<div class="container mt-4 ">
<div class="p-3 bg-white mb-10">
            <b><h3>Retirar saldo</h3></b>
            <div class="form-group">
            <form  method="POST" action="{{ route('user-withdraw-balance') }}">
                @csrf
        <input type="number" id="dineroRetirar" name="dineroRetirar" min="5" step=".01" class="form-control" placeholder="Euros" aria-label="Euros" aria-describedby="basic-addon1">

    <small class="form-text text-muted">La cantidad minima son 5 euros</small>
  </div>

            <select name="creditcard" class="form-control">
            @foreach($user->creditCards as $cc)
                <option value="{{ $cc->id }} ">{{ $cc->num }} </option>
            @endforeach
            </select>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Retirar saldo</button>
            </div>
            </form>
        </div>
</div>
</div> 

<div class="container mt-4 ">
    <div class="p-3 bg-white mt-200">
        
        <!-- Button trigger modal -->
        <div class="d-flex bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCreditCard">
                        Añadir una tarjeta de credito
                </button>

                        
                    <div class="modal fade" id="addCreditCard" tabindex="-1" role="dialog" aria-labelledby="addCreditCard" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCreditCard">Añadir tarjeta de credito</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form  action="{{ route('session-add-creditcard') }}" method="POST">
                            @method('POST')
                            @csrf
                            <label for="title" class="form-label">Numero de la tarjeta </label>
                            <input type="text" class="form-control mb-2" name="num" id="num" placeholder="Ej. 5121123487651321" value="">

                            <label for="title" class="form-label">CVV </label>
                            <input type="text" class="form-control mb-2" name="cvv" id="cvv" placeholder="Ej. 767" value="">

                            <label for="title" class="form-label">Mes de caducidad</label>
                            <input type="text" class="form-control mb-2" name="cadMonth" id="cadMonth" placeholder="Ej. 01" value="">

                            <label for="title" class="form-label">Año de caducidad</label>
                            <input type="text" class="form-control mb-2" name="cadYear" id="cadYear" placeholder="Ej. 2024" value="">


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                    <button type="submit" class="btn btn-success">Añadir</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>

            </div>
            <div class="ml-auto p-2 bd-highlight">
                    <form action="{{ route('users-index') }}">
                        <input type="submit" value="Volver" class="btn btn-primary my-2" />
                </form>
                </div>

            </div>

            <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">Numero de tarjeta</th>
                <th scope="col">CVV</th>
                <th scope="col">Cad Mes</th>
                <th scope="col">Cad Año</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
        @foreach($user->creditCards as $cc)
            <tbody>
                <tr>
                <td>{{ $cc->num }}</td>
                <td>{{ $cc->cvv }}</td>
                <td>{{ $cc->cadMonth }}</td>
                <td>{{ $cc->cadYear }}</td>
                <td>                     

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCc{{ $cc->id }}">
                        Eliminar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteCc{{ $cc->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCcModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCcModal">Eliminar usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Estás seguro que deseas eliminar la tarjeta con id <b> {{ $cc->id }}</b> del usuario <b>{{ $user->name }}</b> con id <b>{{ $user->id }}</b>. Esta accion no será reversible
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="{{ route('creditcards-delete', ['id' => $cc->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>

     
                        <button type="submit" data-toggle="modal" data-target="#editCreditCard{{ $cc->id }}" class="btn btn-warning btn-sm">Editar</button>


                                            
                    <div class="modal fade" id="editCreditCard{{ $cc->id }}" tabindex="-1" role="dialog" aria-labelledby="editCreditCard" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCreditCard{{ $cc->id }}">Editar tarjeta de credito</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form  action="{{ route('creditcards-update', ['id' => $cc->id]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <label for="title" class="form-label">Numero de la tarjeta </label>
                            <input type="text" class="form-control mb-2" name="num" id="num" placeholder="Ej. 5121123487651321" value="{{ $cc->num }}">

                            <label for="title" class="form-label">CVV </label>
                            <input type="text" class="form-control mb-2" name="cvv" id="cvv" placeholder="Ej. 767" value="{{ $cc->cvv }}">

                            <label for="title" class="form-label">Mes de caducidad</label>
                            <input type="text" class="form-control mb-2" name="cadMonth" id="cadMonth" placeholder="Ej. 01" value="{{ $cc->cadMonth }}">

                            <label for="title" class="form-label">Año de caducidad</label>
                            <input type="text" class="form-control mb-2" name="cadYear" id="cadYear" placeholder="Ej. 2024" value="{{ $cc->cadYear }}">


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                    <button type="submit" class="btn btn-warning">Editar</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>

                </td>
                </tr>
            </tbody>
        @endforeach
        </table>
            
        
    </div>


@endsection