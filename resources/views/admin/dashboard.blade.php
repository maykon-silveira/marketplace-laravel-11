<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel Administrador</title>
</head>
<body>
<h1>Painel Administrador</h1>
<p>{{ Auth::user()->name }}</p>

<x-dropdown-link :href="route('profile.edit')">
    {{ __('Meus Dados') }}
</x-dropdown-link>

<!-- Authentication -->
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        {{ __('Sair') }}
    </x-dropdown-link>
</form>


</body>
</html>

