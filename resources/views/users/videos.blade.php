@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-between items-center gap-3 py-10">
    @if (auth()->user()->image)
        <img src="{{ auth()->user()->image }}" alt="" class="w-20 h-20 rounded-full object-contain">
    @else
        <img src="{{ asset('profile.png') }}" alt="" class="w-20 h-20 rounded-full object-contain">
    @endif
    <p class="text-gray-300">&#64;{{ $user->username }}</p>
    <button class="px-5 py-1.5 bg-secondary rounded-md text-white hover:bg-gray-700 mt-5">
        Subscribe
    </button>
</div>
<div class="flex justify-center text-gray-300 border-b border-zinc-600 px-20">
    <a href="{{ route('users.videos', auth()->user()->id) }}" class="px-5 py-1 border-b-[3px] border-secondary">Videos</a>
    <a href="{{ route('users.about', auth()->user()->id) }}" class="px-5 py-1 border-b border-primary">About</a>
    @if($user->id == auth()->user()->id)
    <a href="{{ route('users.settings', auth()->user()->id) }}" class="px-5 py-1 border-b border-primary">Settings</a>
    @endif
</div>
<div class="grid grid-cols-4 gap-10 p-10">
       
       @foreach($videos as $video)
       <div class="w-[380px] mb-7">
          <a href="/video/{{ $video->id }}" class="col-span-1">
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
         </a>
        </div>
     @endforeach
     
    
   
       </div>
@endsection