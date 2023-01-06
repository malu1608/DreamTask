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
                                   <div class="btn bg-body">
                                        <span class="h6">Status :</span>
                                        <select id="statusoptions" name="status">
                                            <option value="inprogress">In Progress</option>
                                            <option value="todo">To Do</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                        <i class="ri-arrow-down-s-line ml-2 mr-0"></i>
                                    </div>
                                   </div>
                                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton03">
                                       <a class="dropdown-item" href="{{route('editProfile')}}"><i class="ri-mic-line mr-2"></i>In Progress</a>
                                       
                                   </div>
                               </div>
                             
                               <div class="pl-3 border-left btn-new">
                                   <a href="#" class="btn btn-primary" onclick="toggleModal()">New Project</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div id="new-project-modal-back" class="hide"></div>
       <div id="new-project-modal" class="hide">
            <form action="" method="post">
                {{ csrf_field() }}

                <h2>New Project</h2>

                <label for="name">Project Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                <span class="error">
                    {{ $errors->first('name') }}
                </span>
                @endif

                <label for="description">Description</label>
                <input id="description" type="text" name="description" value="{{ old('description') }}" required>
                @if ($errors->has('description'))
                <span class="error">
                    {{ $errors->first('description') }}
                </span>
                @endif

                <div style="display: flex; flex-direction: row;">

                    <button type="submit" class="btn btn-primary">Create</button>
                    <div class="btn btn-secondary" onclick="toggleModal()">Cancel</div>
                </div>
                
            </form>
       </div>

       <div id="grid" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
        @foreach ($projects as $project)
           
               <div class="col-lg-4 col-md-6 project_status_{{$project->project_status}}">
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
                                   <a href=""></a>
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


function toggleModal() {
    document.querySelector('#new-project-modal-back').classList.toggle('hide')
    document.querySelector('#new-project-modal').classList.toggle('hide')
}

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

let statusOption = document.querySelector('#statusoptions');

if (statusOption != null) {
    statusOption.addEventListener('change', (ev) => {
        console.log(statusOption.selectedIndex)
        switch (statusOption.selectedIndex) {
            case 0:
                document.querySelectorAll('.project_status_In').forEach(element => {
                    element.style.display = 'block'
                });
                document.querySelectorAll('.project_status_To').forEach(element => {
                    element.style.display = 'none'
                });
                document.querySelectorAll('.project_status_Completed').forEach(element => {
                    element.style.display = 'none'
                });
                break;
            case 1:
                document.querySelectorAll('.project_status_In').forEach(element => {
                    element.style.display = 'none'
                });
                document.querySelectorAll('.project_status_To').forEach(element => {
                    element.style.display = 'block'
                });
                document.querySelectorAll('.project_status_Completed').forEach(element => {
                    element.style.display = 'none'
                });
                break;
            case 2:
                document.querySelectorAll('.project_status_In').forEach(element => {
                    element.style.display = 'none'
                });
                document.querySelectorAll('.project_status_To').forEach(element => {
                    element.style.display = 'none'
                });
                document.querySelectorAll('.project_status_Completed').forEach(element => {
                    element.style.display = 'block'
                });
                break;
        
            default:
                break;
        }
    })
}
</script>
@endsection


            