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
                        <!--check if the user do like-->
                        <?php $user_like = false; ?>
                        
                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        
                        @if($user_like)
                            <img src="{{asset('img/hearts_red.png')}}" data-id="{{$image->id}}" class="btn-dislike"/>
                        @else
                            <img src="{{asset('img/hearts_black.png')}}" data-id="{{$image->id}}" class="btn-like"/>
                        @endif
                        <span class="num_likes">{{count($image->likes)}}</span>
                    </div>
                    
                    @if(Auth::user() && Auth::user()->id == $image->user->id)
                        <div class="action">
                            <a href="{{route('image.edit',['id' => $image->id])}}" class="btn btn-sm btn-primary">Edit</a>
                            
                            
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                Delete
                            </button>

                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Modal Heading</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            If you delete this image you will loss all information about it. Are you sure do you want to delete this image?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                            <a href="{{route('image.delete',['id' => $image->id])}}" class="btn btn-danger">Delete</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
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
