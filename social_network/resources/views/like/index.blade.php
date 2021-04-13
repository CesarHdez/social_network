@extends('layouts.app')

@section('content')
<!--<link href="{{ asset('css/style.css') }}" rel="stylesheet">-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2>Favorites pictures</h2>

            @foreach($likes as $like)
                @include('includes.image',['image'=>$like->image])
            @endforeach
            <!--Pagination-->
            <div class="clearfix"></div>
            {{$likes->links()}}
        </div>
    </div>
</div>
@endsection
