@extends('layouts.app')
@section('content')
    <div class="posts">
        <h2 class="heading">
            All Profiles
        </h2>
        <br><br><hr>

            <span class="profiles">
                @foreach ($profiles as $profile)
                    <a href="/profiles/{{$profile->user->username}}">
                        <h1>{{$profile->user->username}}</h1>
                        <h2>{{$profile->topic}}</h2>
                        <h2>{{$profile->description}}</h2>
                    </a>
                    <br><br>
                @endforeach
            </span>
    </div>
@endsection


