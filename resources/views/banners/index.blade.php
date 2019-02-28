@extends('layouts.app')

@section('titulo', 'Banners')

@section('content')
    <div class="container">

        <h3>Sistema de Banners</h3>
        <div class="divider"></div>

        <div class="section">
            <nav>
                <div class="nav-wrapper blue">
                    <div class="col s12">
                        <a href="#!" class="breadcrumb">Home</a>
                        <a href="#!" class="breadcrumb">Banners</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="section">
            <table class="highlight centered">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
                </thead>

                <tbody>
                @forelse($data as $banner)
                    <tr>
                        <td>{{$banner->name}}</td>
                        <td>{{$banner->description}}</td>
                        <td width="17%"><img class="materialboxed"
                                             data-caption="Banner {{$banner->name}}"
                                             width="150" width="300"
                                             src="{{$banner->url}}">
                        <td><a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                               data-tooltip="Editar" href="{{route('banners.edit', $banner->id)}}"> <i
                                    class="small material-icons">edit</i></a>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nada</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>


@endsection
