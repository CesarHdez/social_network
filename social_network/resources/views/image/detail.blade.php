@extends('layouts.app')

@section('content')
<!--<link href="{{ asset('css/style.css') }}" rel="stylesheet">-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.show_message')
            <div class="card pub_image pub_image_detail">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" class="avatar">
                    </div>
                    @endif
                    <div class="data-user">
                        {{'@'.$image->user->nick}}                       
                    </div>

                </div>
                <div class="card-body">
                    <div class="image-container image-detail">
                       <img src="{{route('image.file',['filename'=>$image->image_path])}}" >
                    </div>
                    
                    <div class="description">
                        {{$image->description.' | '}}
                        <span class="date">{{\FormatTime::LongTimeFilter($image->created_at)}}</span>
                    </div>
                    
                    <div class="likes">
                        <img src="{{asset('img/hearts_black.png')}}" />
                    </div>
                    <div class="clearfix"></div>
                    <div class="comments">
                        <h3>Comments ({{count($image->comments)}})</h3>
                        <hr>
                        <form method="POST" action="">
                            @csrf
                            
                            <input type="hidden" name="image_id" value="{{$image->id}}" />
                            <p>
                                <textarea class="form-control" name="content" required></textarea>
                            </p>
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
