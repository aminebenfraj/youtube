@if($video)
    <h1>{{ $video->title }}</h1>

    @if($video->description)
        <p>Description: {{ $video->description }}</p>
    @endif

    <p>Views Count: {{ $video->views_count }}</p>

    @if($video->userid)
        <p>User ID: {{ $video->userid }}</p>
    @endif

    @if($video->userid)
        <video width="640" height="360" controls autoplay muted>
            <source src="{{ $video->url }}" type="video/mp4">
        </video>
    @endif

    <a href="{{ route('videos.edit', $video->id) }}">Edit</a>

    <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@else
    <p>Video not found.</p>
@endif