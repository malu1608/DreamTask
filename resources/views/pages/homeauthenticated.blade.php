@extends('layouts.app')

@section('title', 'Home Page')

@section('content')


<section id= "navbar">
          
                    <div class="searchcontainer">
                        <div class="wrap">
                            <div class="search">
                                <p>Start searching for your project!</p>
                                <input type="text" placeholder="Search..">
                                <button type="submit"> <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
          
</section>

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




    
@endsection
