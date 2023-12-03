<h1>{{ $user->name }}</h1>

<p>Email: {{ $user->email }}</p>

<a href="{{ route('users.edit', $user->id) }}">Edit</a>

<form action="{{ route('users.destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>