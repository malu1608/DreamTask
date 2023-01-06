@extends('layouts.app')

@section('title', 'User')

@section('content')

<section id="user">
  <article class="user">
    <p class="h4 font-weight-bold">{{$user["first_name"]}} {{$user["first_name"]}}</p>
    {{-- <img src="{{ asset( 'img/' . $user->photo) }}" style="width:170px;height:170px;"/> --}}    
      <a class="btn btn-primary" href="{{ route('editProfile') }}" >Edit profile</a>
      <a class="btn btn-danger" href="{{ route('editProfile') }}"> Delete profile</a>
  </article>
</section>

@endsection