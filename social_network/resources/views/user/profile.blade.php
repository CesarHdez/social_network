@extends('layouts.app')

@section('content')
<!--<link href="{{ asset('css/style.css') }}" rel="stylesheet">-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="profile-user">
                @if($user->image)
                <div class="container-avatar">
                    <img src="{{route('user.avatar',['filename'=>$user->image])}}" class="avatar">
                </div>
                @endif

                <div class="user-info">
                    <h2>{{'@'.$user->nick}}</h2>
                    <h3>{{$user->name .' '. $user->surname}}</h3>
                    <p>{{'Joined' .\FormatTime::LongTimeFilter($user->created_at)}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
            @foreach($user->images as $image)
                @include('includes.image',['image'=>$image])
            @endforeach

        </div>
    </div>
</div>
@endsection
