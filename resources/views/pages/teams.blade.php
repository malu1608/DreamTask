@extends('layouts.app')

@section('title', 'Teams')

@section('content')

    <h1>{{ $project_name }}'s teams</h1>

    <div style="display: flex; flex-direction: row; flex-wrap: wrap;">

        @foreach ($teams as $team)
            <div class="col-lg-4 col-md-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <a href="/project/team/{{ $team->id_team }}/tasks">
                            <h3>{{ $team->name }}</h3>
                        </a>
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
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
