<h1>Create New Video</h1>

<form action="{{ route('videos.store') }}" method="POST">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="description">Description:</label>
    <textarea name="description"></textarea>

    <label for="views_count">Views Count:</label>
    <input type="number" name="views_count" required>

    <label for="userid">User ID:</label>
    <input type="number" name="userid" required>

    <button type="submit">Create Video</button>
</form>