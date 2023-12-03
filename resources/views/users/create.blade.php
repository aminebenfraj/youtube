<h1>Create New User</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Create User</button>
</form>