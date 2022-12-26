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
                                        
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search tasks..." />                            
                                        <div class="table-responsive" >
                                            <table class="table table-striped ">
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                
      
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    <?php echo view('partials.card', ['tasks' => $tasksToDo, 'title' => 'To Do']); ?>
    <?php echo view('partials.card', ['tasks' => $tasksInProgress, 'title' => 'In Progress']); ?>
    <?php echo view('partials.card', ['tasks' => $tasksCompleted, 'title' => 'Completed']); ?>
</section>
</div>
</div> 

<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action_task') }}",
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
@endsection
