<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if($user->roles->isNotEmpty())
    <p>Roles:</p>
    <ul>
        @foreach($user->roles as $role)
            <li>{{ $role->ROL_LABEL }}</li>
        @endforeach
    </ul>
    @else
        <p>Cet utilisateur n'a aucun rôle.</p>
    @endif

</body>
</html>
