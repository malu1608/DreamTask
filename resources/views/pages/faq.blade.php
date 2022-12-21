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
                What is DreamTask and how does it work ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                DreamTask allows the users to have control of all their workflow by controlling and planning their activities and by helping to build the right line-up in order to assemble the perfect project.
              </div>
            </div>
            <hr class="linhafaq">
            <div class="faq-item">
              <h3>
                Who is DreamTask for ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                You! And it’s not just for you. The DreamTask allow any type of user, whether corporate related like startups, consultants, small companies, large businesses, and many others, to have control of all their workflow.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                Why should I use DreamTask ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                DreamTask is an app that helps their users to build the right line-up in order to assemble the perfect project by letting them have control of all their workflow.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                Is DreamTask free ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                Everything that is possible to be done by a user is completely free.
              </div>
            </div>
            <hr>
            <div class="faq-item">
              <h3>
                How do I start using DreamTask ?
                <span class="faq-plus">&plus;</span>
              </h3>
              <div class="faq-body">
                We saved the best for last. All you need is a DreamTask account and internet access.
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
