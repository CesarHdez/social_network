@extends('layouts.app')

@section('content')
<!--<link href="{{ asset('css/style.css') }}" rel="stylesheet">-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Community</h1>
            <form method="GET" action="{{route('users')}}" id="searcher">
                <div class="row">
                    <div class="form-group col-md-8">
                        <input type="text" id="search" class="form-control"/> 
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="Search" class="btn btn-primary"/>   
                    </div>
                </div>
            </form>
            <hr>
            @foreach($users as $user)
            <div class="profile-user">
                @if($user->image)
                <div class="container-avatar">
                    <img src="{{route('user.avatar',['filename'=>$user->image])}}" class="avatar">
                </div>
                @endif

                <div class="user-info">
                    <a href="{{route('user.profile', ['id' => $user->id])}}">
                        <h2>{{'@'.$user->nick}}</h2>
                        <h3>{{$user->name .' '. $user->surname}}</h3>
                    </a>
                    <p>{{'Joined' .\FormatTime::LongTimeFilter($user->created_at)}}</p>
                    
                </div>
                
            <div class="clearfix"></div>
            <hr>
            </div>
            @endforeach
            <!--Pagination-->
            <div class="clearfix"></div>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
