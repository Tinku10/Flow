@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>{{$user->username}}</h1>
                    @if ($user->profile != null)
                        <h3>{{$user->profile->description}}</h3>
                        <h4>{{$user->profile->website}}</h4>
                        <br>
                        <a href="/profiles/edit">Edit Profile</a>
                    @else
                        <div class="links">
                            COMPLETE YOUR PROFILE
                            <form action="/profiles/{{$user->username}}" method="post">
                                @csrf
                                Add a description <br>
                                <input type="text" name="description"> <br>
                                Add your website <br>
                                <input type="text" name="website"> <br>
                                <input type="submit" value="UPDATE"> <br>
                            </form>

                        </div>
                        @endif
                        <a href="/profiles/{{$user->username}}">My Profile</a>
                        <a href="/post/create">New Post</a>

                        <br><br>
                        <p>{{session('message')}}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
