@extends('layouts.guest')
@section('title','| Ricetta UNICT')
@section('script')
<script type="text/javascript" src="{{asset('js/login.js')}}" defer></script>
<script type="text/javascript" src="{{asset('js/carica.js')}}" defer></script>
@endsection
    <link rel='stylesheet' href="{{ asset('css/login.css') }}">
@section('content')
<body>
    <header>
      <nav>
        <div id="links">
          <div>
        <?php
                if (old('username')||old('password')) {
                    echo "<span class='errorj'>Username e/o password errati.</span>";
                }
                
            ?>
          <a class="button">Login</a>
          <form class="Hidden" method="post" action='/login'>
          @csrf
            <input type="text" name="username" placeholder='username'>
            <input type="password" name="password" placeholder='Password'>
            <input type="submit" id="submit" value="Invia">
            <div class="Signup">Non hai un account? <a href="register/index">Iscriviti</a>
          </form>
          </div>
        </div>
      </nav>

      <h1  id="titolo">
        <em>Ricette Unict</em><br/>
      </h1>

    </header>
    <section class="nuova_vista">
    </section>
    <footer>
        <div> Damiano Samperi 1000003371</div>
    </footer>
  </body>
@endsection