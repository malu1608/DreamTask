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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
</script>
  </head>
  <body>
    <main>
      <header>
        <h1><a href="{{ url('/home') }}"> DreamTask</a></h1>
        @if (Auth::check())
        <a class="button" href="{{ url('/logout') }}"> Logout </a> <span>{{ Auth::user()->name }}</span>
        @endif
        <!-- 
        <img src="icons/bell.svg" alt="Bell Icon" width="38" height="38" id="notificationBellButton" onclick="viewNotifications()">
        <a id=notificationsDropdownAnchor>
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
      -->
      <h1 style="font-size: 25px;" > <a href="{{ url('/cards') }}"> Log In  </a> </h1>
      <h1><a class="button" href="{{ url('/logout') }}"> Sign Up </a></h1>
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
