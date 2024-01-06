<div id="sidebar" class="w-64 h-full flex flex-col gap-5 px-2 pt-2 transition-all">
      <div class="flex flex-col gap-5 text-gray-200 px-2 text-sm">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
          <i class="material-icons">home</i>
          <span>Home</span>
        </a>
        <a href="{{ route('videos.trending') }}" class="flex items-center gap-2">
          <i class="material-icons">local_fire_department</i>
          <span>Trending</span>
</a>
        
      </div>
      <hr class="border-t border-gray-600" />
      @guest
      <div class="flex flex-col gap-2 items-center">
          <p class="text-gray-300 text-sm">Sign in to like videos, comment, and subscribe.</p>
          <a class="flex items-center gap-2 text-gray-400 border border-gray-400 hover:text-gray-200 hover:border-gray-200 group rounded-md py-0.5 px-2 font-medium" href="{{ route('login') }}">
            <i class="material-icons text-2xl text-gray-400 group-hover:text-gray-200 display-this">account_circle</i>
            Sign in
        </a>
        </div>
      <hr class="border-t border-gray-600" />
      @endauth
      <div class="flex flex-col gap-5 text-gray-200 px-2 text-sm">
      <a href="{{ route('videos.subscriptions') }}" class="flex items-center gap-2">
          <i class="material-icons">subscriptions</i>
          <span>Subscriptions</span>
</a>
        <!-- <div class="flex items-center gap-2">
          <i class="material-icons">history</i>
          <span>History</span>
        </div> -->
        <a href="{{ route('videos.mine') }}" class="flex items-center gap-2">

          <i class="material-icons">play_arrow</i>
          <span>Your Videos</span>
</a>
        <a href="{{ route('videos.liked') }}" class="flex items-center gap-2">
          <i class="material-icons">thumb_up</i>
          <span>Liked Videos</span>
</a>
      </div>
      <hr class="border-t border-gray-600" />
    </div>