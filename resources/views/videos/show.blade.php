@extends('layouts.app')

@section('content')
<div class="video-container w-full h-fit p-10 text-white">

    @if($video)
    


    <video controls autoplay muted class="w-full grid-video-video">
        <source src="{{ $video->url }}" type="video/mp4">
    </video>
    <h1 class="grid-video-title text-3xl my-5">{{ $video->title }}</h1>
    
    <div class="grid-video-actions flex items-center justify-between">
        <div class="flex items-center gap-5">
        <div class="flex items-center gap-2">
           <img src="{{ $user->image }}" alt="" class="w-10 h-10 rounded-full" /> 
           <div><p>{{ $user->username }}</p></div>
        </div>
        <a href="">Subscribe</a>
        </div>
        <div>
            
        <a href="{{ route('videoreaction.like', $video->id) }}">{{ $likes }} likes</a>
    
    <a href="{{ route('videoreaction.dislike', $video->id) }}">{{ $dislikes }} dislikes</a>
        </div>
        
        
    </div>

    
    <div class="grid-video-information flex items-center justify-between">
        <p>{{ $video->views_count }} views</p>
        <p>{{ $video->created_at }}</p>
        

       
    <!-- <a href="{{ route('videos.edit', $video->id) }}">Edit</a>
    
    <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button> -->
    </form>


    </div>

    <p class="grid-video-description">Description: {{ $video->description }}</p>

    <div class="grid-video-comments">
    <form action="{{ route('comments.store', $video->id) }}" method="post">
      @csrf
      <div class="col-span-full">
					<label for="comment" class="text-gray-300">Add a comment</label>
					<input id="comment" type="text" name="comment"  class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
          <button class="px-10 py-2 bg-secondary rounded-md text-white hover:bg-gray-700">
              Comment
          </button>
				</div>
    </form>
    @foreach($comments as $comment)
    <div class="mb-10">

      <p>{{ $comment->content }}</p>
      <div class="flex gap-1 mt-1 relative">
        
        <a href="{{ route('commentreaction.like', ['commentid' => $comment->id,'videoid' => $video->id]) }}">{{ $comment->likes }} likes</a>
        
        <a href="{{ route('commentreaction.dislike', ['commentid' => $comment->id,'videoid' => $video->id]) }}">{{ $comment->dislikes }} dislikes</a>
        
        <button type="button" onclick="handleShowReplyForm({{ $comment->id }})">reply</button>
      </div>
      <form class="hidden" action="{{ route('replies.store', ['commentid' => $comment->id,'videoid' => $video->id]) }}" method="post" id="replyform{{$comment->id}}">
        @csrf
        <div class="col-span-full">
          <label for="reply" class="text-gray-300">Add a reply</label>
					<input id="reply" type="text" name="reply"  class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
          <button class="px-5 py-1 bg-secondary rounded-md text-white hover:bg-gray-700">
            reply
          </button>
				</div>
      </form>
      <div>
        <div class="hidden" id="showreplies{{ $comment->id }}">
          @foreach($comment->replies as $reply)
          <div>
            <p>{{ $reply->content }}</p>
            <div class="flex gap-1 mt-1 relative">
            <a href="{{ route('replyreaction.like', ['replyid' => $reply->id,'videoid' => $video->id]) }}">{{ $reply->likes }} likes</a>
        
            <a href="{{ route('replyreaction.dislike', ['replyid' => $reply->id,'videoid' => $video->id]) }}">{{ $reply->dislikes }} dislikes</a>
            </div>
          </div>
      <!-- <div class="flex gap-1 mt-1 relative">

        <a href="{{ route('commentreaction.like', ['commentid' => $comment->id,'videoid' => $video->id]) }}">{{ $comment->likes }} likes</a>
        
        <a href="{{ route('commentreaction.dislike', ['commentid' => $comment->id,'videoid' => $video->id]) }}">{{ $comment->dislikes }} dislikes</a>
        
      </div> -->
      @endforeach
      </div>

        <button type="button" onclick="handleShowReplies({{ $comment->id }})">show replies</button>
      </div>
    </div>
    @endforeach
    </div>
    
    <div class="grid-video-recommended">
    <a href="/video/{{ $video->id }}">
       <div class="w-full mb-7">
        <div class="w-full h-52">
            <img src="{{ $video->thumbnail }}" alt="" class="bg-cover h-full w-full rounded-md" />
          </div>
          <div class="flex mt-2.5">
            <div class="author shrink-0">
              <img src="http://aninex.com/images/srvc/web_de_icon.png" alt="" class="rounded-full bg-cover h-8 w-8 mr-2.5" />
            </div>
            <div class="flex flex-col">
              <h3 class="text-gray-300 leading-[18px] text-sm mb-1.5">
                {{ $video->title }}
              </h3>
              <a href="" class="text-sm no-underline text-gray-500">{{ $video->user->username }}</a>
              <span class="text-sm no-underline text-gray-500">{{ $video->views_count }} Views • {{ $video->created_at }} Months Ago</span>
            </div>
          </div>
       </div>
       </a>

       <a href="/video/{{ $video->id }}">
       <div class="w-full mb-7">
        <div class="w-full h-52">
            <img src="{{ $video->thumbnail }}" alt="" class="bg-cover h-full w-full rounded-md" />
          </div>
          <div class="flex mt-2.5">
            <div class="author shrink-0">
              <img src="http://aninex.com/images/srvc/web_de_icon.png" alt="" class="rounded-full bg-cover h-8 w-8 mr-2.5" />
            </div>
            <div class="flex flex-col">
              <h3 class="text-gray-300 leading-[18px] text-sm mb-1.5">
                {{ $video->title }}
              </h3>
              <a href="" class="text-sm no-underline text-gray-500">{{ $video->user->username }}</a>
              <span class="text-sm no-underline text-gray-500">{{ $video->views_count }} Views • {{ $video->created_at }} Months Ago</span>
            </div>
          </div>
       </div>
       </a>
       
    </div>
    <script>
    function handleShowReplyForm(commentId) {
      document.getElementById(`replyform${commentId}`).classList.toggle('show-reply-form');
    }
    function handleShowReplies(commentId) {
      
      document.getElementById(`showreplies${commentId}`).classList.toggle('show-replies');
    }
</script>
</div>
@else
<p>Video not found.</p>
@endif
  

@endsection
