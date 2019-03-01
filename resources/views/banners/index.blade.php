@extends('layouts.app')

@section('titulo', 'Banners')

@section('breadcrumb')
    <a href="{{route('banners.index')}}" class="breadcrumb">Banners</a>
@endsection

@section('content')

    <ul class="collapsible">
        <li>
            <div class="collapsible-header"><i class="material-icons">filter_list</i>Filtros</div>
            <div class="collapsible-body white">
                <form method="POST" action="{{ route('banners.filtrar') }}">
                    <div class="row">
                        <div class="input-field col s6 m4 l3">
                            <input id="name" class="tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Digite um nome..." type="text" name="name">
                            <label for="name">Nome</label>
                        </div>
                        <div class="input-field col s6 m4 l3">
                            <input id="description" class="tooltipped" data-position="top" data-delay="50"
                                   data-tooltip="Digite uma descrição..." type="text" name="description">
                            <label for="description">Descrição</label>
                        </div>
                        <div class="input-field col s6 m4 l5">
                            <select name="imagem">
                                <option value="" disabled selected>Possui imagem</option>
                                <option value="1">Não</option>
                                <option value="2">Sim</option>
                            </select>
                            <label>Possui imagem</label>
                        </div>
                        <div class="input-field col s1 m1 l1">
                            <button type="submit" class="btn-floating tooltipped" data-position="top" data-delay="50"
                                    data-tooltip="Clique aqui para pesquisar"><i class="material-icons">search</i>
                            </button>
                        </div>
                        {{csrf_field()}}
                    </div>
                </form>

            </div>
        </li>
    </ul>

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
                                         src="{{$banner->url}}"></td>
                    <td><a class="modal-trigger tooltipped" data-position="top" data-delay="50"
                           data-tooltip="Editar" href="{{route('banners.edit', $banner->id)}}"> <i
                                class="small material-icons">edit</i></a>
                        <a data-target="modal1" class="modal-trigger tooltipped" data-position="top"
                           data-delay="50"
                           data-tooltip="Deletar" href="#modal1" data-id="{{$banner->id}}"
                           data-name="{{$banner->name}}"><i
                                class="small material-icons">delete</i></a></td>

                </tr>
            @empty
                <tr>
                    <td colspan="4">Nada</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$data->links()}}
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large blue" href="{{route('banners.create')}}">
            <i class="large material-icons">add</i>
        </a>
    </div>


    <div id="modal1" class="modal">
        <form action="{{route('banners.destroy', 'delete')}}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <h4>Deletar</h4>
                <p>Você tem certeza que deseja deletar o banner abaixo?</p>
                <div class="row">
                    <label for="name_delete">Nome:</label>
                    <div class="input-field col s12">
                        <input class="validate" hidden name="id" type="number" id="id-delete">
                        <input disabled class="validate" type="text" id="name-delete">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn red delete" type="submit">Sim</button>
            </div>
        </form>
    </div>

@endsection
