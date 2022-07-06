@extends('layouts.guest')
@section('title','| Registrazione Ricetta UNICT')
@section('script')
 <script type="text/javascript" src="{{asset('js\signup.js')}}" defer></script>
@endsection
 <link rel='stylesheet' href="{{ asset('css/Signup.css') }}">
@section('content')
<header>
  <h1  id="titolo">
    <em>REGISTRAZIONE</em><br/>
  </h1>
</header>
<body>
    <section class="nuova_vista">
        <main>
          <form method='post' action='/register'>Registrati
            @csrf 
            <div><br></div>
            <div class='username'><label>Username <input type='text' name='username' ></label><span class='errorj'><br></span></div>
            <div class='password'><label>Password <input type='password' name='password' ></label><span class='errorj'><br></span></div>
            <div class='cellulare'><label>Cellulare <input type='text' name='cellulare' ></label><span class='errorj'><br></span></div>
            <div class='email'><label>E-mail <input type='text' name='email' ></label><span class='errorj'><br></span></div>
            <input type='submit' id="submit" value="Invia" disabled>
            <div class="Login">Hai un account? <a href="\">Accedi</a>
          </form>
        </main>
    </section>
</body>
@endsection


