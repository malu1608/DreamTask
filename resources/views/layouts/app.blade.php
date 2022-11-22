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
    <link href="{{ asset('css/homeaupage.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
</script>
  </head>
  <body>
    <main>
      <header>
        <h1><a href="{{ url('/home') }}"> DreamTask</a></h1>
        @if (Auth::check())
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
        <span>{{ Auth::user()->name }}</span>  <a class="button" href="{{ url('/logout') }}"> Logout </a> 

      @endif
      @if (!Auth::check())
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
