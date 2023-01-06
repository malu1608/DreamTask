<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/milligram.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/aboutpage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contactus.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homeaupage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/bck.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript" src={{ asset('js/app.js') }}></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

<!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"> </script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"> </script>

  </head>
  <body>
    <main>
      <header>
        
        @if (Auth::check())
        <h1><a href="{{ url('/homeauthenticated') }}"> DreamTask</a></h1>
        <h1>
          <a id=notificationsDropdownAnchor>

          <span class="material-symbols-outlined bell" onclick="viewNotifications()">
            notifications
          </span> 
          <div id="notificationsDropdown" class="notificationsDropdownHidden">
            <ul>
              <li>
                notificacao 1
              </li>
              <li>
                notificacao 2
              </li>
            </ul>
          </div>
        </a>
        </h1>
        <a>{{ Auth::user()->getName() }}</a>  
        <a class="button" href="{{ url('/logout') }}"> Logout </a> 

      @endif
      @if (!Auth::check()) 
      <h1><a href="{{ url('/home') }}"> DreamTask</a></h1>
      <h1 style="font-size: 25px;" > <a href="{{ url('/login') }}"> Log In  </a> </h1>
      <h1><a class="button" href="{{ url('/register') }}"> Sign Up </a></h1> 
      @endif
      
      </header>
    
      @yield('content')
      <div class="footer-dark">
        <footer>
              <div class="footerbox">
                  <div class="footerow">
                      <div class="copyright">DreamTask © 2022</div>

                      <div>
                      <a href="/aboutus">
                          <h3>About us </h3>
                      </a>    
                      </div>
                      <div>
                      <a href="/contactus">
                          <h3>Contact us </h3>
                      </a>
                      </div>
                      
                      <div>
                      <a href="/faq">
                          <h3>FAQ</h3>
                          </a>
                      </div>    
                      <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                  </div>
                  
              </div>
          </footer>
        </div>
    </main>
  </body>
</html>
