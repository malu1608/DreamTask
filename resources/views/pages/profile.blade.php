@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

<h2 class="mt-3">Profile</h2>
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item active">Profile</li>
  	</ol>
</nav>
<div class="row mt-4">
	@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>

	@endif
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">Edit User</div>
			<div class="card-body">
				<form method="post" action="{{ route('profile.edit_validation') }}">
					@csrf
					<div class="form-group mb-3">
		        		<label><b>Username</b></label>
		        		<input type="text" name="username" class="form-control" placeholder="username" value="{{ $data->username }}" />
		        		@if($errors->has('username'))
		        		<span class="text-danger">{{ $errors->first('username') }}</span>
		        		@endif
		        	</div>
                    <div class="form-group mb-3">
		        		<label><b>First Name</b></label>
		        		<input type="text" name="first_name" class="form-control" placeholder="first_name" value="{{ $data->first_name }}" />
		        		@if($errors->has('first_name'))
		        		<span class="text-danger">{{ $errors->first('first_name') }}</span>
		        		@endif
		        	</div>
                    <div class="form-group mb-3">
		        		<label><b>Last Name</b></label>
		        		<input type="text" name="last_name" class="form-control" placeholder="last_name" value="{{ $data->last_name }}" />
		        		@if($errors->has('last_name'))
		        		<span class="text-danger">{{ $errors->first('last_name') }}</span>
		        		@endif
		        	</div>
		        	<div class="form-group mb-3">
		        		<label><b>User Email</b></label>
		        		<input type="text" name="email" class="form-control" placeholder="Email" value="{{ $data->email }}" />
		        		@if($errors->has('email'))
		        		<span class="text-danger">{{ $errors->first('email') }}</span>
		        		@endif
		        	</div>
                    <div class="form-group mb-3">
		        		<label><b>Description</b></label>
		        		<input type="text" name="description" class="form-control" placeholder="description" value="{{ $data->description }}" />
		        		@if($errors->has('description'))
		        		<span class="text-danger">{{ $errors->first('description') }}</span>
		        		@endif
		        	</div>
		        	<div class="form-group mb-3">
		        		<label><b>Password</b></label>
		        		<input type="password" name="password" class="form-control" placeholder="Password" />
		        	</div>
		        	<div class="form-group mb-3">
		        		<input type="submit" class="btn btn-primary" value="Edit" />
		        	</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
