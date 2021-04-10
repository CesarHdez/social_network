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
                        <h5>Comments ({{count($image->comments)}})</h5>
                        <hr>
                        <form method="POST" action="{{route('comment.save')}}">
                            @csrf
                            
                            <input type="hidden" name="image_id" value="{{$image->id}}" />
                            <p>
                                <textarea name="content" class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}"></textarea>
                                @if($errors->has('content'))
                                <samp class="invalid-feedback" role="alert">
                                    <strong> {{$errors->first('content')}} </strong>
                                </samp>
                                @endif   
                            </p>
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                        <hr>
                        @foreach($image->comments as $comment)
                        <div class="comments">
                            <div class="comment-detail">
                                {{'@'.$comment->user->nick.' | '}}
                                <span class="date">{{\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                            </div>
                            <p>{{$comment->content}}
                                <br>
                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                <a href="{{route('comment.delete',['id' => $comment->id])}}" class="btn btn-sm btn-danger">Delete</a>
                                @endif
                            </p>
                            
                        </div>
                        @endforeach
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
