@extends('layouts.app')

@section('content')
<div class="w-full h-full px-8 py-4">

    <div class="flex flex-col items-center">

        @foreach($videos as $video)
        <div class="w-[380px] mb-7">
            <a href="/video/{{ $video->id }}" class="col-span-1">
                <div class="w-full h-52">
                    <img src="{{ $video->thumbnail }}" alt="" class="bg-cover h-full w-full rounded-md" />
                </div>
                <div class="flex mt-2.5">
                    <div class="author shrink-0">
                        @if($video->user->image)
                        <img src="{{ $video->user->image }}" alt="" class="rounded-full bg-cover h-8 w-8 mr-2.5" />
                        @else
                        <img src="{{ asset('profile2.png') }}" alt="" class="rounded-full bg-cover h-8 w-8 mr-2.5" />
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-gray-300 leading-[18px] text-sm mb-1.5">
                            {{ $video->title }}
                        </h3>
                        <a href="" class="text-sm no-underline text-gray-500">{{ $video->user->username }}</a>
                        <span class="text-sm no-underline text-gray-500">{{ $video->formatted_views_count }} Views • {{
                            $video->formatted_created_at }}</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div>
@endsection