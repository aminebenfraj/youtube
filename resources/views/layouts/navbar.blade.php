<div class="flex justify-between items-center h-16 px-10 py-2">
    <div class="flex items-center gap-5">
        <button id="menu">
            <i class="material-icons text-gray-300">menu</i>
        </button>
        <a href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" class="w-40">
        </a>
    </div>

    <form class="flex items-center h-16 mt-3">
        <input type="text" placeholder="Type to search" class="text-sm w-96 text-gray-200 px-2 border-none focus:outline-none rounded-l-full bg-transparent h-9" />
    </form>
    
    <div class="flex gap-6 items-center">
        <a class="text-gray-300 font-medium" href="{{ route('users.login') }}">
            Login
        </a>
        <a class="flex items-center gap-2 text-gray-300 border border-secondary hover:text-gray-200 hover:border-gray-200 group rounded-md py-0.5 px-2 font-medium" href="{{ route('users.register') }}">
            <i class="material-icons text-2xl text-secondary group-hover:text-gray-200 display-this">account_circle</i>
            Sign up
        </a>
    </div>
    
</div>
