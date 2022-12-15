@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<body class="faq">
    <div class="container">
      <div class="row">
        <div class="faq-wrapper">
          <div class="header">
            <h1>FAQs</h1>
          </div>
          <div class="faq-inner">
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </div>
            </div>
            <hr class="linhafaq">
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                What is an FAQ page ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(".faq-plus").on('click',function(){
        $(this).parent().parent().find('.faq-body').slideToggle();
      });
    </script>
  </body>














@endsection