@extends('layouts.app')

@section('title', 'Teams')

@section('content')

    <h1>Your teams</h1>

    <div style="height: 100%; background-color: white; display: flex; flex-direction: row; flex-wrap: wrap;">

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
                                <li>
                                    {{ $member->first_name . ' ' . $member->last_name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
