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
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, assumenda soluta omnis ipsum, possimus voluptatum nesciunt, accusamus sapiente quam blanditiis distinctio rerum labore quibusdam inventore consequuntur aperiam provident? Totam, necessitatibus?</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, dignissimos animi aspernatur distinctio delectus laborum eos vel perferendis, ullam non provident beatae voluptates et officia dicta sed placeat amet perspiciatis!

    </p>
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
    
    
    
    
    
  
</div>
    @else
    <p>Video not found.</p>
    @endif

@endsection
