<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index(){
        $profiles = Profile::all();
        return view('profiles.index', ['profiles'=>$profiles]);
    }

    public function show($user){
        $user = \App\User::where('username', $user)->first();
        // dd($user->post);
        // $profile = Profile::find($user);
        // dd($profile->username);
        return view('profiles.show', ['profile'=>$user->profile]);
    }

    public function store(){
        // $data = request()->validate([
        //     'description'=>'required',
        //     'website'=>'required',
        //     'user_id'=>''
        // ]);
        // auth()->user()->profile()->create($data);
        $profile = new Profile();
        $profile->description = request('description');
        $profile->website = request('website');
        $profile->user_id = auth()->user()->id;
        $profile->save();
        return redirect('/home')->with('user', $profile->user());
        // return view('home', ['user'=> $profile->user]);
    }

    public function create(){
        $user = auth()->user();
        return view('profiles.create', ['user'=>$user]);
    }

    public function update(){
        $user = auth()->user();
        $profile = $user->profile;
        $profile->delete();
        $profile = new Profile();
        $profile->description = request('description');
        $profile->website = request('website');
        $profile->user_id = auth()->user()->id;
        $profile->save();
        return redirect('/home')->with('user', $user);

    }


}
