<div class="flex justify-between items-center h-16 px-10 py-2">
    <div class="flex items-center gap-5">
        <button id="menu">
            <i class="material-icons text-gray-300">menu</i>
        </button>
        <a href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" class="w-40">
        </a>
    </div>

    <form class="flex items-center mt-3  rounded-full bg-transparent h-10 px-5 border border-gray-700" action="{{ route('videos.search') }}" method="GET">
        <input type="text" name="query" placeholder="Type to search" class="text-sm w-96 text-gray-200 border-none ring-0 focus:ring-0 bg-transparent outline-none rounded-l-full" value="{{ $query ?? old('query') }}" />
        <button><img src="{{ asset('search.png') }}" width="20" /></button>
    </form>
    
    <div class="flex gap-6 items-center">
    @auth
        <a href="{{ route('videos.create') }}"><img src="{{ asset('upload2.png') }}" width="20" /></a>
        <div class="relative text-gray-300 font-medium flex items-center gap-2 group hover:bg-white/5 px-2 py-1 rounded cursor-pointer">
            @if (auth()->user()->image)
                <img src="{{ auth()->user()->image }}" width="25" class="rounded-full object-contain">
            @else
                <img src="{{ asset('profile2.png') }}" width="25">
            @endif
            {{ auth()->user()->username }}
            <div class="hidden group-hover:flex absolute top-full w-40 right-0 p-4 flex-col items-center gap-5 shadow-2xl bg-primary rounded-md">
                <a href="{{ route('users.videos', auth()->user()->id) }}" class="whitespace-nowrap">My videos</a>
                <a href="{{ route('users.settings', auth()->user()->id) }}" class="whitespace-nowrap">My settings</a>
                <a class="text-red-500 font-medium" href="{{ route('logout') }}" class="whitespace-nowrap"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
        </div>
        
       
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <a class="text-gray-300 font-medium" href="{{ route('login') }}">
            Login
        </a>
        <a class="flex items-center gap-2 text-gray-300 border border-secondary hover:text-gray-200 hover:border-gray-200 group rounded-md py-0.5 px-2 font-medium" href="{{ route('register') }}">
            <i class="material-icons text-2xl text-secondary group-hover:text-gray-200 display-this">account_circle</i>
            Sign up
        </a>
    @endauth
</div>

    
</div>
