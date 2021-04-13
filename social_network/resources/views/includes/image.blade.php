<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
        <div class="container-avatar">
            <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" class="avatar">
        </div>
        @endif
        <div class="data-user">
            <a href="{{ route('user.profile', ['id' => $image->user->id]) }}">
                {{'@'.$image->user->nick}}
            </a>

        </div>

    </div>
    <div class="card-body">
        <div class="image-container">
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

        <div class="comments">
            <a href="{{ route('image.detail', ['id'=>$image->id])}}" class="btn btn-sm btn-secondary btn-comments">
                Comments ({{count($image->comments)}})
            </a>
        </div>

    </div>
</div>