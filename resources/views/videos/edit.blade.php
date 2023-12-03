<h1>Edit Video - {{ $video->title }}</h1>

<form action="{{ route('videos.update', $video->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="title">Title:</label>
    <input type="text" name="title" value="{{ $video->title }}" required>

    <label for="description">Description:</label>
    <textarea name="description">{{ $video->description }}</textarea>

    <label for="views_count">Views Count:</label>
    <input type="number" name="views_count" value="{{ $video->views_count }}" required>

    <label for="userid">User ID:</label>
    <input type="number" name="userid" value="{{ $video->userid }}" required>

    <button type="submit">Update Video</button>
</form>