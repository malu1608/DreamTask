@extends('layouts.app')

@section('title', 'Admin')

@section('content')

<section id="admin">
@if($user->is_admin)
<h3>Look for a user:</h3>
  <div class="search-bar row">
    <div class="col-md-6">
    <form action="{{route('showAdminUsers')}}" method="GET">
      <input class="form-control" type="text" name="search">
      </div>
      <div class="col">
      <button class="btn btn-info" type="submit">Search</button>
      </div>
    </form>
  </div>
  <p>______________________________________________________________</p>
  <h3>List of users:</h3>
  <table id="users">
    <tr>
        <th>Id </th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach($users as $user)
      <tr>
        <td>{{$user["id_user"]}}</td>
        <td><a href="/user/{{$user->id}}"><font color="black">{{$user["first_name"]}} {{$user["last_name"]}} </td>
        <td>{{$user["email"]}}</td>
      </tr>
    @endforeach
  </table>
@endif
<p> </p>
</section>


@endsection
