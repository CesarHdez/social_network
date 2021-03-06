@extends('layouts.app')

@section('content')
<!--<link href="{{ asset('css/style.css') }}" rel="stylesheet">-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.show_message')
            @foreach($images as $image)
                @include('includes.image',['image'=>$image])
            @endforeach
            <!--Pagination-->
            <div class="clearfix"></div>
            {{$images->links()}}
        </div>
    </div>
</div>
@endsection
