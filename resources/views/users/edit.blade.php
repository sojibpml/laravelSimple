<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Admin</title>
</head>

<body>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $user->name }}">
        <input type="email" name="email" value="{{ $user->email }}">
        <label for="">Roles</label>
        @foreach ($roles as $role)
            @if (auth()->user()->hasRole('admin'))
                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                {{ in_array($role->id, $user_roles) ? 'checked' : '' }}> {{ $role->name }}
            @endif
        @endforeach
        <button type="submit">Update</button>
    </form>
</body>

</html>
