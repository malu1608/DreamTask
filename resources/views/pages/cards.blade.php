@extends('layouts.app')

@section('title', 'Cards')

@section('content')
<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                            <h5>Your Tasks</h5>
                            <div id= "navbar">
          
                                <div class="searchcontainer">
                                    <div class="wrap">
                                        <div class="search">
                                        
                                            <input type="text" placeholder="Search..">
                                            <button type="submit"> <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>

<div class="taskboardbar">
  <div>
  <span onclick="openNav()">&#9776; open project information
  <script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  </script>
  
    <div class="texttk">Task Board </div>
    <hr>
  
</div>
</div>
  </span>
    

<div class="pagespace">
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">Project name</a>
    <a id=usersDropdownAnchor>
    <a href="#" >Team name <i class=" fa fa-arrow-down" onclick="viewUsers()"></i></a>
    <div id="usersDropdown" class="usersDropdownHidden">
            <ul>
              <li>
                user 1
              </li>
              <li>
                user 2
              </li>
            </ul>
          </div>
        </a>
    <a href="#">Team Forum</a>
    </div>
  <section id="cards">
  @each('partials.card', $cards, 'card')
  <article class="card">
    <form class="new_card">
      <input class="newitembar" type="text" name="name" placeholder="new card">
    </form>
  </article>
</section>
</div>
</div> 
@endsection
