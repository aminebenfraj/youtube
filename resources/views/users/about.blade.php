@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-between items-center gap-3 py-10">
    @if (auth()->user()->image)
        <img src="{{ auth()->user()->image }}" alt="" class="w-20 h-20 rounded-full object-contain">
    @else
        <img src="{{ asset('profile.png') }}" alt="" class="w-20 h-20 rounded-full object-contain">
    @endif
    <p class="text-gray-300">&#64;{{ $user->username }}</p>
    <a
        class="px-4 py-1.5 text-sm font-bold bg-secondary rounded-md text-primary hover:bg-gray-700 hover:text-gray-300" href="{{ route('subscription.create', $user->id) }}">
        Subscribe
      </a>
</div>
<div class="flex justify-center text-gray-300 border-b border-zinc-600 px-20">
    <a href="{{ route('users.videos', auth()->user()->id) }}" class="px-5 py-1 border-b border-primary">Videos</a>
    <a href="{{ route('users.about', auth()->user()->id) }}" class="px-5 py-1 border-b-[3px] border-secondary">About</a>
    @if($user->id == auth()->user()->id)
    <a href="{{ route('users.settings', auth()->user()->id) }}" class="px-5 py-1 border-b border-primary">Settings</a>
    @endif
</div>
<div class="p-10 text-gray-300 flex flex-col gap-5">
    <p class="text-sm"><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p class="text-sm"><strong>Phone number:</strong> {{ auth()->user()->phone }}</p>
    <p class="text-sm"><strong>Bio:</strong> {{ auth()->user()->bio }}</p>
</div>
@endsection