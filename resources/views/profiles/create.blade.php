@extends('layouts.app')

@section('content')
    <div class="links">
        EDIT YOUR PROFILE
        <form action="/profiles/update" method="post">
            @csrf
            Add a description
             <br>
            <input type="text" name="description"  value="{{$user->profile->description}}"> <br>
            Add your website
             <br>
            <input type="text" name="website"  value="{{$user->profile->website}}" > <br>
            <br>
            <input type="submit" value="UPDATE"> <br>
        </form>

    </div>
@endsection
