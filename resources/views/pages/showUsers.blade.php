@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<h3>List of users:</h3>
<section id="admin">
  
@if($user->is_admin)

  <table id="users">
    <tr>
        <th>Id </th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach($users as $user)
      <tr>
        <td>{{$user["id_user"]}}</td>
        <td><a href="/user/{{$user->id}}">{{$user["first_name"]}} {{$user["last_name"]}} </td>
        <td>{{$user["email"]}}</td>
      </tr>
    @endforeach
  </table>

@endif
</section>


@endsection
