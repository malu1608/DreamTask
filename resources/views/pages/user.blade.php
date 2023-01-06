@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user">
  <article class="user">
    <p class="h4 font-weight-bold">{{$user["first_name"]}} {{$user["first_name"]}}</p>
    <img src="{{ asset( 'img/' . $user->photo) }}" style="width:170px;height:170px;"/>
    <p> </p>
    @if (Auth::user()->id == $user->id && !Auth::user()->is_admin)
      <a class="btn btn-primary" href="{{ route('edit') }}" required style="max-width: 120px">Edit profile</a>
      <a class="btn btn-danger" href="{{ route('edit') }}" required style="max-width: 120px">Delete profile</a>
    @endif
    @if (Auth::user()->is_admin)
      <a class="btn btn-primary" href="{{ route('edit') }}" required style="width: 30em">Edit profile</a>
    @endif

    
  </article>
</section>

@endsection