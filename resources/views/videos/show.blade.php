@extends('layouts.app')

@section('content')
<div class="video-container w-full h-fit px-10 py-5 text-white">

  @if($video)

  <video controls autoplay muted class="w-full grid-video-video rounded-lg">
    <source src="{{ $video->url }}" type="video/mp4">
  </video>
  <h1 class="grid-video-title text-3xl my-5">{{ $video->title }}</h1>

  <div class="grid-video-actions flex items-center justify-between">
    <div class="flex items-center gap-5">
      <div class="flex items-center gap-2">
        @if($user->image)
        <img src="{{ $user->image }}" alt="" class="w-10 h-10 rounded-full" />
        @else
        <img src="{{ asset('profile.png') }}" alt="" class="w-10 h-10 rounded-full" />

        @endif
        <p>{{ $user->username }}</p>
      </div>
      @if(auth()->user()->id == $user->id)
      <button class="px-4 py-1.5 text-sm bg-secondary rounded-md text-white hover:bg-gray-700 hover:text-gray-300">
        Edit video
      </button>
      <button class="px-4 py-1.5 text-sm bg-secondary rounded-md text-white hover:bg-gray-700 hover:text-gray-300">
        Delete video
      </button>
      @else
      <a
        class="px-4 py-1.5 text-sm font-bold bg-secondary rounded-md text-primary hover:bg-gray-700 hover:text-gray-300" href="{{ route('subscription.create', $user->id) }}">
        Subscribe
      </a>
      @endif
    </div>
      
      <div class="flex items-start text-gray-300 rounded-full border border-gray-500 text-[15px]">
        <a href="{{ route('videoreaction.like', $video->id) }}"
        class="flex items-center gap-1 py-1 pl-3 pr-2 hover:bg-zinc-950/50 rounded-l-full"><img
        src="{{ asset('like.png') }}" width="27"> {{ $likes }} </a>
        
        <a href="{{ route('videoreaction.dislike', $video->id) }}"
        class="flex items-center gap-1 py-1 pl-2 pr-3 rounded-r-full relative before:absolute before:h-6 before:w-[1px] before:top-1.5 before:left-0 before:bg-gray-300 hover:bg-zinc-950/50 "><img
        src="{{ asset('dislike.png') }}" width="27"> {{ $dislikes }}</a>
      </div>

  </div>


  <div class="grid-video-information flex items-center justify-end gap-5 mt-5">
    <p>{{ $video->formatted_views_count }} views</p>

    <p>{{ $video->formatted_created_at }}</p>

  </div>

  <p class="grid-video-description mt-5 bg-zinc-700/20 p-5 rounded-2xl text-sm">{{ $video->description }}</p>

  <div class="grid-video-comments mt-10">
    <form action="{{ route('comments.store', $video->id) }}" method="post" class="mb-10">
      @csrf
      <div class="col-span-full flex flex-col">
        <label for="comment" class="text-gray-300">Add a comment</label>
        <input id="comment" type="text" name="comment"
          class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
        <button class="px-10 py-2 bg-gray-700 rounded-md text-white hover:bg-zinc-500/20 text-sm self-end mt-2">
          Comment
        </button>
      </div>
    </form>
    @foreach($comments as $comment)
    <div class="mb-7">

      <div class="flex items-start gap-5">
        @if($comment->user->image)
        <img src="{{ $comment->user->image }}" alt="" class="w-10 h-10 rounded-full" />
        @else
        <img src="{{ asset('profile2.png') }}" alt="" class="w-10 h-10 rounded-full" />
        @endif
        <div class="flex flex-col gap-0.5 text-sm">
          <p class="text-gray-300">{{ $comment->user->username }}</p>

          <p class="text-gray-200">{{ $comment->content }}</p>
        </div>
      </div>
      <div class="flex items-center gap-4 mt-2 relative ml-14">

        <a href="{{ route('commentreaction.like', ['commentid' => $comment->id,'videoid' => $video->id]) }}"
          class="flex items-center gap-0.5 text-gray-300"><img src="{{ asset('like.png') }}" width="25"> {{
          $comment->likes }} </a>

        <a href="{{ route('commentreaction.dislike', ['commentid' => $comment->id,'videoid' => $video->id]) }}"
          class="flex items-center gap-0.5 text-gray-300"><img src="{{ asset('dislike.png') }}" width="25"> {{
          $comment->dislikes }}</a>

        <button type="button" onclick="handleShowReplyForm({{ $comment->id }})" class="text-gray-300">reply</button>
      </div>
      <form class="hidden my-2"
        action="{{ route('replies.store', ['commentid' => $comment->id,'videoid' => $video->id]) }}" method="post"
        id="replyform{{$comment->id}}">
        @csrf
        <div class="col-span-full">
          <input id="reply" type="text" name="reply"
            class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
          <div class="w-full flex items-center justify-end gap-3  mt-2">
            <button type="button" onclick="handleShowReplyForm({{ $comment->id }})" class="text-gray-300 text-sm">
              cancel
            </button>
            <button class="px-10 py-2 bg-gray-700 rounded-md text-white hover:bg-zinc-500/20 text-sm self-end">
              Reply
            </button>
          </div>
        </div>
      </form>
      <div>
        <div class="hidden pl-14 my-7" id="showreplies{{ $comment->id }}">
          @foreach($comment->replies as $reply)
          <div class="">
            <div class="flex items-start gap-5">
            @if($reply->user->image)
            <img src="{{ $reply->user->image }}" alt="" class="w-10 h-10 rounded-full" />
            @else
            <img src="{{ asset('profile2.png') }}" alt="" class="w-10 h-10 rounded-full" />
            @endif
              <div class="flex flex-col gap-0.5 text-sm">
                <p class="text-gray-300">{{ $reply->user->username }}</p>

                <p class="text-gray-200">{{ $reply->content }}</p>
              </div>
            </div>
            <div class="flex items-center gap-4 mt-2 relative ml-14">
              <a href="{{ route('replyreaction.like', ['replyid' => $reply->id,'videoid' => $video->id]) }}" class="flex items-center gap-0.5 text-gray-300"><img src="{{ asset('like.png') }}" width="25"> {{
              $reply->likes }}</a>

                  <a href="{{ route('replyreaction.dislike', ['replyid' => $reply->id,'videoid' => $video->id]) }}" class="flex items-center gap-0.5 text-gray-300"><img src="{{ asset('dislike.png') }}" width="25"> {{
              $reply->dislikes }}</a>
            </div>
          </div>
          @endforeach
        </div>
        @if(!$comment->replies->isEmpty())
        <button type="button" id="showrepliesbutton{{ $comment->id }}" onclick="handleShowReplies({{ $comment->id }})"
          class="ml-14 text-gray-300 hover:bg-zinc-200/10 px-5 py-1 rounded-full mt-2">show replies</button>
        @endif
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
            <img src="http://aninex.com/images/srvc/web_de_icon.png" alt=""
              class="rounded-full bg-cover h-8 w-8 mr-2.5" />
          </div>
          <div class="flex flex-col">
            <h3 class="text-gray-300 leading-[18px] text-sm mb-1.5">
              {{ $video->title }}
            </h3>
            <a href="" class="text-sm no-underline text-gray-500">{{ $video->user->username }}</a>
            <span class="text-sm no-underline text-gray-500">{{ $video->views_count }} Views • {{ $video->created_at }}
              Months Ago</span>
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
            <img src="http://aninex.com/images/srvc/web_de_icon.png" alt=""
              class="rounded-full bg-cover h-8 w-8 mr-2.5" />
          </div>
          <div class="flex flex-col">
            <h3 class="text-gray-300 leading-[18px] text-sm mb-1.5">
              {{ $video->title }}
            </h3>
            <a href="" class="text-sm no-underline text-gray-500">{{ $video->user->username }}</a>
            <span class="text-sm no-underline text-gray-500">{{ $video->views_count }} Views • {{ $video->created_at }}
              Months Ago</span>
          </div>
        </div>
      </div>
    </a>

  </div>
  <script>
    const sidebar = document.querySelector('#sidebar');
   
    const mainBody = document.querySelector('.mainBody');
   
    sidebar.classList.toggle('show-sidebar');
    mainBody.classList.toggle('expand-body');

    function handleShowReplyForm(commentId) {
      document.getElementById(`replyform${commentId}`).classList.toggle('show-reply-form');
    }
    function handleShowReplies(commentId) {
      document.getElementById(`showrepliesbutton${commentId}`).style.display = 'none'
      document.getElementById(`showreplies${commentId}`).classList.toggle('show-replies')    }
  </script>
</div>
@else
<p>Video not found.</p>
@endif


@endsection