<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Banners') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>

<header>
    <nav>
        <div class="nav-wrapper blue">
            <div class="container">
                <a href="#!" class="brand-logo">Banners</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="{{route('banners.index')}}">Listar</a></li>
                    <li><a href="{{route('banners.create')}}">Cadastrar</a></li>
                    @if(Auth::check())
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form></li>
                    @else
                        <li><a href="{{route('login')}}">Login</a></li>
                        <li><a href="{{route('register')}}">Registrar</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="{{route('banners.index')}}">Banners</a></li>
        <li><a href="{{route('banners.create')}}">Cadastrar</a></li>
        @if(Auth::check())
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form></li>
        @else
            <li><a href="{{route('login')}}">Login</a></li>
            <li><a href="{{route('register')}}">Registrar</a></li>
        @endif
    </ul>
</header>

<main>
    <div class="container">
        <h3>Sistema de Banners</h3>
        <div class="divider"></div>

        @include('layouts._breadcrumb')

        @include('layouts._mensagem-erro')

        @yield('content')
    </div>
</main>

<script>

    M.AutoInit();

    $(document).on('click', '.modal-trigger', function () {
        console.log($(this).data('name'));
        $('#id-edit').val($(this).data('id'));
        $('#id-delete').val($(this).data('id'));
        $('#id-relatorio').val($(this).data('id'));
        $('#name-edit').val($(this).data('name'));
        $('#name-delete').val($(this).data('name'));
        $('#name-relatorio').val($(this).data('name'));
    });


    $("#crud-delete").click(function (e) {
        e.preventDefault();
        var form_action = $("#delete-item").find("form").attr("action");
        var id = $("#delete-item").find("input[name='id']").val();
        $.ajax({
            dataType: 'json',
            type: 'DELETE',
            url: form_action,
            data: {id: id}
        }).done(function () {
            $("#" + id).remove();
            var Modalelem = document.querySelector('#delete-item');
            var instance = M.Modal.getInstance(Modalelem);
            instance.close();
            M.toast({html: 'Deletado com sucesso!'});
        });
    });

</script>

</body>
</html>
