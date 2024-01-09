@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-between items-center gap-3 py-10">
    @if ($user->image)
    <img src="{{ $user->image }}" alt="" class="w-20 h-20 rounded-full object-contain">
    @else
    <img src="{{ asset('profile.png') }}" alt="" class="w-20 h-20 rounded-full object-contain">
    @endif
    <p class="text-gray-300">&#64;{{ $user->username }}</p>
    @if($isSubscribed)
    <a class="px-4 py-1.5 text-sm font-bold bg-gray-700 rounded-md text-gray-300 hover:bg-zinc-500"
        href="{{ route('subscription.create', $user->id) }}">
        Subscribed
    </a>
    @else
    <a class="px-4 py-1.5 text-sm font-bold bg-secondary rounded-md text-primary hover:bg-gray-700 hover:text-gray-300"
        href="{{ route('subscription.create', $user->id) }}">
        Subscribe
    </a>
    @endif
</div>
<div class="flex justify-center text-gray-300 border-b border-zinc-600 px-20">
    <a href="{{ route('users.videos', $user->id) }}" class="px-5 py-1 border-b border-primary">Videos</a>
    <a href="{{ route('users.about', $user->id) }}" class="px-5 py-1 border-b border-primary">About</a>
    @if(auth()->user() && $user->id == auth()->user()->id)
    <a href="{{ route('users.settings', $user->id) }}" class="px-5 py-1 border-b-[3px] border-secondary">Settings</a>
    @endif
</div>
<section class="p-6 text-gray-300">
    <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm">
        <div class="space-y-2 col-span-full lg:col-span-1">
            <p class="font-medium">Profile and personal information</p>
            <p class="text-xs">Update your username, email, etc...</p>
        </div>
        <form enctype="multipart/form-data" action="{{ route('users.update') }}" method="POST"
            class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
            @csrf
            @method('PUT')
            <div class="col-span-full sm:col-span-3">
                <label for="username" class="text-sm">Username</label>
                <input id="username" name="username" type="text"
                    class="w-full rounded-md bg-primary border text-gray-300" value="{{ $user->username }}">
            </div>
            <div class="col-span-full sm:col-span-3">
                <label for="phone" class="text-sm">Phone Number</label>
                <input id="phone" name="phone" type="number" class="w-full rounded-md bg-primary border text-gray-300"
                    value="{{ $user->phone }}">
            </div>
            <div class="col-span-full">
                <label for="email" class="text-sm">Email</label>
                <input id="email" name="email" type="email" class="w-full rounded-md bg-primary border text-gray-300"
                    value="{{ $user->email }}">
            </div>
            <div class="col-span-full">
                <label for="bio" class="text-sm">Bio</label>
                <textarea id="bio" name="bio" col="50" row="4"
                    class="w-full rounded-md bg-primary border text-gray-300">{{ $user->bio }}</textarea>
            </div>
            <div class="col-span-full">
                <p class="text-sm">Photo</p>
                <div class="flex items-center space-x-2">
                    @if ($user->image)
                    <img src="{{ $user->image }}" id="profile-image" alt=""
                        class="w-20 h-20 rounded-full object-contain">
                    @else
                    <img src="{{ asset('profile.png') }}" id="profile-image" alt=""
                        class="w-20 h-20 rounded-full object-contain">
                    @endif
                    <label for="profile" class="px-4 py-2 border rounded-md">
                        Change
                    </label>
                    <input type="file" class="invisible" name="profile" id="profile" accept="image/*"
                        class="rounded-lg flex-1 appearance-none border border-gray-600 w-full py-3 px-4 bg-primary text-gray-200 placeholder-gray-400 shadow-sm text-sm outline-none ring-0 focus:ring-0 focus:outline-none focus:border-gray-400 mt-2">
                </div>
            </div>
            <div class="col-span-full flex justify-center">
                <button class="bg-secondary px-12 py-2 rounded-md shadow-xl text-primary">
                    Save
                </button>
            </div>
        </form>
    </fieldset>
    <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm">
        <div class="space-y-2 col-span-full lg:col-span-1">
            <p class="font-medium">Security</p>
            <p class="text-xs">Update your password</p>
        </div>
        <form action="{{ route('users.security') }}" method="POST"
            class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
            @csrf
            @method('PUT')
            <div class="col-span-full">
                <label for="oldPassword" class="text-sm">Old password</label>
                <input id="oldPassword" name="oldPassword" type="password"
                    class="w-full rounded-md bg-primary border text-gray-300">
            </div>
            <div class="col-span-full">
                <label for="newPassword" class="text-sm">New password</label>
                <input id="newPassword" name="newPassword" type="password"
                    class="w-full rounded-md bg-primary border text-gray-300">
            </div>
            <div class="col-span-full">
                <label for="confirmNewPassword" class="text-sm">Confirm new password</label>
                <input id="confirmNewPassword" name="newPassword_confirmation" type="password"
                    class="w-full rounded-md bg-primary border text-gray-300 focus:ring focus:ri focus:ri ">
            </div>
            <div class="col-span-full flex justify-center">
                <button class="bg-secondary px-12 py-2 rounded-md shadow-xl text-primary">
                    Save
                </button>
            </div>
        </form>
    </fieldset>
</section>
<script>
    const profileImage = document.getElementById('profile-image')
    const profileInput = document.getElementById('profile')
    profileInput.addEventListener("change", (e) => {
        const target = e.target;
        const files = target?.files;
        const reader = new FileReader();
        reader.onload = async function () {
            if (reader.result)
                profileImage.src = reader.result
        };
        if (files) reader.readAsDataURL(files[0]);
    })
</script>
@endsection