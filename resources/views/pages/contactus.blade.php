

@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="my-3">Contact Us</h1>
    <hr>

    <!-- Content Row -->
    <div class="row pb-3">
      <!-- Map Column -->
      <div class="col-md-8">
        <!-- Embedded Google Map -->
        <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=41.177967,-8.5960284&amp;t=m&amp;z=15&amp;output=embed"></iframe>
      </div>
      <!-- Contact Details Column -->
      <div class="col-md-4">
        <h3>Contact details</h3>
        <p>
          Faculdade de Engenharia (FEUP)<br>Rua Dr. Roberto Frias<br>4200-465 PORTO<br>
        </p>
        <p><i class="fa fa-phone"></i>
          <abbr title="Phone"></abbr> (+351) 22 508 14 00</p>
        <p><i class="fa fa-envelope"></i>
          <abbr title="Email"></abbr> <a href="mailto:feup@fe.up.pt">feup@fe.up.pt</a>
        </p>
        <p><i class="fa fa-clock"></i>
          <abbr title="Hours"></abbr> Monday - Sunday: 24h</p>
      </div>
    </div>
  </div>
@endsection
