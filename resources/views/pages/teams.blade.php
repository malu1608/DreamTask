@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div style="display: flex; flex-direction: column;">
                        <h1>{{ $project->name }}'s teams</h1>
                        @if (Auth::user()->is_admin)
                            <form action="/project/{{ $project->id_project }}/info" method="post">
                                @csrf
                                <textarea name="description" id="" cols="30" rows="10"> {{ $project->description }}</textarea>
                                <button type="submit">Update</button>
                            </form>
                        @else
                            {{ $project->description }}
                        @endif
                    </div>
                    <div class="pl-3 border-left btn-new">
                        <a href="#" class="btn btn-primary" onclick="toggleModal()">New Team</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="new-project-modal-back" class="hide"></div>
    <div id="new-project-modal" class="hide">
        <form action="/project/{{ $project->id_project }}/create_team" method="post">
            {{ csrf_field() }}

            <h2>New Team</h2>

            <label for="name">Team Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="error">
                    {{ $errors->first('name') }}
                </span>
            @endif
            <label for="field">Team Field</label>
            <input id="field" type="text" name="field" value="{{ old('field') }}" required autofocus>
            @if ($errors->has('field'))
                <span class="error">
                    {{ $errors->first('field') }}
                </span>
            @endif

            <div style="display: flex; flex-direction: row; justify-content: space-evenly;">
                <button type="submit" class="btn btn-primary">Create</button>
                <button type="reset" class="btn btn-secondary" onclick="toggleModal()">Cancel</button>
            </div>

        </form>
    </div>

    <div style="display: flex; flex-direction: row; flex-wrap: wrap;">

        @foreach ($teams as $team)
            <div class="col-lg-4 col-md-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <form action="/project/{{ $project->id_project }}/delete_team" method="post"
                            style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; align-items: center;">
                            @csrf
                            <a href="/project/team/{{ $team->id_team }}/tasks">
                                <h3 style="margin: 0;">{{ $team->name }}</h3>
                            </a>
                            @if (Auth::user()->isCoordinator($team->id_team) || Auth::user()->is_admin)
                                <input type="number" name="id_team" value="{{ $team->id_team }}" style="display:none;">
                                <button type="submit" style="background-color: darkred;">
                                    <span class="material-symbols-outlined">
                                        close
                                    </span>
                                </button>
                            @endif
                        </form>
                        <div>{{ count($team->members()) }} members</div>
                        <ul>
                            @foreach ($team->members() as $member)
                                <li
                                    style="display:flex; flex-direction: row; justify-content: space-between; align-items: center">
                                    {{ $member->first_name . ' ' . $member->last_name }}
                                    @if (Auth::user()->isCoordinator($team->id_team) || Auth::user()->is_admin)
                                        @if (Auth::user()->id_user != $member->id_user)
                                            <form action="" method="post" style="margin: 0;">
                                                @csrf
                                                <input type="number" name="id_user" value="{{ $member->id_user }}"
                                                    style="display: none;">
                                                <input type="number" name="id_team" value="{{ $team->id_team }}"
                                                    style="display: none;">
                                                <button type="submit">Remove</button>
                                            </form>
                                        @endif
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @if (Auth::user()->isCoordinator($team->id_team) || Auth::user()->is_admin)
                            <form action="/project/{{ $project->id_project }}/add_member" method="post"
                                style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; align-items: flex-end;">
                                @csrf
                                <div style="display: flex; flex-direction: column;">
                                    <div style="display: flex; flex-direction: row; gap: 10%; align-items: center">
                                        <label for="coordinator">Team Coordinator</label>
                                        <input type="checkbox" name="coordinator">
                                    </div>
                                    <input id="username" type="text" name="username" placeholder="username" required autofocus>
                                    @if ($errors->has('username'))
                                        <span class="error">
                                            {{ $errors->first('username') }}
                                        </span>
                                    @endif
                                </div>
                                <input type="number" name="id_team" value="{{ $team->id_team }}" style="display:none;">
                                <button type="submit">New Team Member</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <script>
        function toggleModal() {
            document.querySelector('#new-project-modal-back').classList.toggle('hide')
            document.querySelector('#new-project-modal').classList.toggle('hide')
        }
    </script>
@endsection
