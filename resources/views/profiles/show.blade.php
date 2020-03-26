@extends('layouts.app')
@section('content')
            <div id="content">
                <div style="align-content: center;">
                    <h1>{{$profile->user->username}}</h1>
                    {{-- <h3>{{$profile->topic}}</h3> --}}
                    <h3>{{$profile->description}}</h3>
                    <h3>{{$profile->website}}</h3>
                </div>
                <br><br>
                <hr>
                <div class="posts">
                    @if ($profile->user->posts != null)
                        @foreach ($profile->user->posts as $post)
                            <h3 class="post">{{$post->title}}</h3>
                            <h3>{{$post->post}}</h3>
                            <br>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
@endsection
