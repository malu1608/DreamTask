@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<section> 
    <div>
        <div class="sloganBox">DreamTask 
        <p>Build better - together</p>
        <input type="text" class="email-bar" placeholder="E-mail">
        <button type="Sign-up" class="email-button">Sign up</button>
        </div>
        <div class="sloganBox"><img src="icons/4380.jpg" alt="cloud" ></div>
        
    </div>
</section>
<section id="b">
    <div data-testid="block" color="rgba(255, 255, 255, 1)">
        <div class="featureBox">
            <p>Boost your performance </p>
            <img src="icons/bolt.svg" alt="Bolt Icon" width="96" height="96">
        </div>
        <div class="featureBox">
            <p>Track teams workflow</p>
            <img src="icons/group.svg" alt="Bolt Icon" width="96" height="96">
        </div>
        <div class="featureBox">
            <p>Manage any project</p>
            <img src="icons/done.svg" alt="Bolt Icon" width="96" height="96">
        </div>
    </div>
    <a id="tryItNowBox" href="/login">
        <h4>Try it now</h4>
    </a>
</section>


    
@endsection
