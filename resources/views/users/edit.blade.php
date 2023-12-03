<h1>Edit User - {{ $user->name }}</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="username">Name:</label>
    <input type="text" name="username" value="{{ $user->username }}" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label for="password">Password (Leave blank to keep unchanged):</label>
    <input type="password" name="password">

    <button type="submit">Update User</button>
</form>