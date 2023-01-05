@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="content-page">
    <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">
               <div class="card">
                   <div class="card-body">
                       <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                           <h5>Your Projects</h5>
                           <div class="d-flex flex-wrap align-items-center justify-content-between">
                               <div class="dropdown status-dropdown mr-3">
                                   <div class="dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown">
                                   <div class="btn bg-body"><span class="h6">Status :</span> In Progress<i class="ri-arrow-down-s-line ml-2 mr-0"></i></div>
                                   </div>
                                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton03">
                                       <a class="dropdown-item" href="#"><i class="ri-mic-line mr-2"></i>In Progress</a>
                                       <a class="dropdown-item" href="#"><i class="ri-attachment-line mr-2"></i>Priority</a>
                                       <a class="dropdown-item" href="#"><i class="ri-file-copy-line mr-2"></i>Category</a> 
                                   </div>
                               </div>
                             
                               <div class="pl-3 border-left btn-new">
                                    
                                   <a href="#" class="btn btn-primary" data-target="#new-project-modal" data-toggle="modal">New Project</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <div id="grid" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
        @foreach ($projects as $project)
           
               <div class="col-lg-4 col-md-6">
                   <div class="card card-block card-stretch card-height">
                       <div class="card-body">
                            <h5 class="mb-1">{{$project->name}}</h5>
                                
                                {{$project->description}}
                                <br>{{$project->company}}
                                                
                           <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                               <div class="iq-media-group">
                                   <a href="#" class="iq-media">
                                       <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/05.jpg" alt="">
                                   </a>
                                   <a href="#" class="iq-media">
                                       <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/06.jpg" alt="">
                                   </a>
                               </div>
                               <a class="btn btn-white text-primary link-shadow">{{$project->current_edit_date}}</a>
                           </div>
                       </div>
                   </div>
                   
               </div>
           @endforeach
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


            