<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>DSSBet - @yield('title')</title>
</head>

<body style="background-color: #ddf5e3d1;">
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('img/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
      DSSBet
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      @guest
      <a href="{{ url('/login') }}" class="btn btn-primary" role="button" data-bs-toggle="button" aria-pressed="true">Iniciar sesión</a>
      <a href="{{ url('/register') }}" class="btn btn-primary" role="button" data-bs-toggle="button" aria-pressed="true">Registrar usuario</a>
      @endguest
      @auth
      {{ Auth::user()->balance }} €
      <a href="{{ url('/logout') }}" class="btn btn-primary" role="button" data-bs-toggle="button" aria-pressed="true">Cerrar sesión</a>
      @endauth

      <span class="navbar-toggler-icon"></span>
    </button>
    @auth

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @isadmin
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/') }}">Indice <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/users') }}">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/games') }}">Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/tickets') }}">Tickets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/admin/ticketlines') }}">TicketLines</a>
        </li>
        @endisadmin
        
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('/bet') }}">Apostar</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/user/tickets') }}">Historial de apuestas</a>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/user/creditcards') }}">Añadir credito</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/user/profile') }}">Perfil</a>
        </li>

      </ul>
    </div>
    @endauth

  </nav>

  <div class="container mt-4 ">
    @yield('content')
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>