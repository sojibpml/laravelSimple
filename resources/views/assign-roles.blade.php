<!DOCTYPE html>
<html>

<head>
    <title>Assign Roles</title>
</head>

<body>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <h2>Assign Roles for {{ $user->name }}</h2>

    <form action="{{ route('assign.roles', $user->id) }}" method="POST">
        @csrf

        @foreach ($roles as $role)
            <label>
                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                {{ ucfirst($role->name) }}
            </label><br>
        @endforeach

        <button type="submit">Assign Roles</button>
    </form>

</body>

</html>
