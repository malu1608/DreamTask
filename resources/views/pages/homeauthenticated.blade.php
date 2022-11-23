@extends('layouts.app')

@section('title', 'Home Page')

@section('content')




     <div class="container-fluid">
     <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                            <h3>Your Projects</h3>
                            <section id= "navbar">
          
                                <div class="searchcontainer">
                                    <div class="wrap">
                                        
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search projects..." />                            
                                        <div class="table-responsive" >
                                            <table class="table table-striped ">
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>

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
                                <div class="list-grid-toggle d-flex align-items-center mr-3">
                                    <div data-toggle-extra="tab" data-target-extra="#grid" class="active">
                                        <div class="grid-icon mr-3">
                                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                        </div>
                                    </div>
                                    <div data-toggle-extra="tab" data-target-extra="#list">
                                        <div class="grid-icon">
                                            <svg  width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line>
                                            </svg>
                                        </div>
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
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="25" data-type="percent"></div>
                                <i class="ri-star-fill m-0 text-warning"></i>
                            </div>
                            <h5 class="mb-1">Theme development</h5>
                            <p class="mb-3">Preparing framework of block-based WordPress Theme.</p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                <div class="iq-media-group">
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/05.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/06.jpg" alt="">
                                    </a>
                                </div>
                                <a class="btn btn-white text-primary link-shadow">High</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div id="circle-progress-02" class="circle-progress circle-progress-secondary" data-min-value="0" data-max-value="100" data-value="30" data-type="percent"></div>
                                <i class="ri-star-fill m-0 text-warning"></i>
                            </div>
                            <h5 class="mb-1">Vuetify Dashboard in Admin</h5>
                            <p class="mb-3">Start development server and check Vue project in browser.</p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                <div class="iq-media-group">
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/07.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/02.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/04.jpg" alt="">
                                    </a>                                                
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/08.jpg" alt="">
                                    </a>
                                </div>
                                <a class="btn btn-white text-secondary link-shadow">Medium</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div id="circle-progress-03" class="circle-progress circle-progress-warning" data-min-value="0" data-max-value="100" data-value="15" data-type="percent"></div>
                                <i class="ri-star-fill m-0 text-warning"></i>
                            </div>
                            <h5 class="mb-1">Wordpress Dashboard Plugins</h5>
                            <p class="mb-3">Customize your WordPress with smart WordPress plugins.</p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                <div class="iq-media-group">
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/01.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/02.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/03.jpg" alt="">
                                    </a>
                                </div>
                                <a class="btn btn-white text-warning link-shadow">Low</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div id="circle-progress-04" class="circle-progress circle-progress-success" data-min-value="0" data-max-value="100" data-value="40" data-type="percent"></div>
                                <i class="ri-star-fill m-0 text-warning"></i>
                            </div>
                            <h5 class="mb-1">Hotel Management App</h5>
                            <p class="mb-3">Build a Cloud-based Hotel Management Theme.</p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                <div class="iq-media-group">
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/05.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/06.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/07.jpg" alt="">
                                    </a>
                                </div>
                                <a class="btn btn-white text-success link-shadow">High</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div id="circle-progress-05" class="circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="25" data-type="percent"></div>
                                <i class="ri-star-fill m-0 text-warning"></i>
                            </div>
                            <h5 class="mb-1">Video Streaming Theme</h5>
                            <p class="mb-3">Launch OTT and media streaming theme.</p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                <div class="iq-media-group">
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/05.jpg" alt="">
                                    </a>
                                    <a href="#" class="iq-media">
                                        <img class="img-fluid avatar-40 rounded-circle" src="../assets/images/user/06.jpg" alt="">
                                    </a>
                                </div>
                                <a class="btn btn-white text-primary link-shadow">High</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>


<section id="b">
    <a id="checkworkspaceBox" href="/cards">
        <h4>Check your Workspace</h4>
    </a> 
    <div class="secondBox">
        <div class="featureBox2">
            <p>Projects </p>
            <span class="material-symbols-outlined" id="formatlist" width="76" height="76">
            format_list_bulleted
            </span>
        </div>
        <div class="featureBox2">
            <p>Teams</p>
            <span class="material-symbols-outlined" id="equipas">
            diversity_2
            </span>
        </div>
        <div class="featureBox2">
            <p>Users</p>
            <img src="icons/group.svg" alt="Bolt Icon" >
        </div>
    </div>
    
</section>

<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action_proj') }}",
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
