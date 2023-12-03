<h1>User List</h1>

<a href="{{ route('users.create') }}">Create New User</a>

<ul>
    @foreach($users as $user)
        <li>
            <a href="{{ route('users.show', $user->id) }}">{{ $user->username }}</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>