<h1>Video List</h1>

<a href="{{ route('videos.create') }}">Create New Video</a>

<ul>
    @foreach($videos as $video)
        <li>
            <a href="{{ route('videos.show', $video->id) }}">{{ $video->title }}</a>
            <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>