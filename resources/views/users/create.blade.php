<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create Admin</title>
</head>

<body>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <label>Roles</label>

        @foreach ($roles as $role)
            @if (auth()->user()->hasRole('admin'))
                <input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->name }}
            @endif
        @endforeach

        <button type="submit">Save</button>
    </form>

</body>

</html>
