@extends('layouts.app')

@section('titulo', 'Editar banner')

@section('breadcrumb')
    <a href="{{route('banners.index')}}" class="breadcrumb">Banners</a>
    <a href="{{route('banners.edit', $banner->id)}}" class="breadcrumb">Editar {{$banner->name}}</a>
@endsection

@section('content')

    <div class="card-panel">
        <div class="row">
            <form class="col s12" method="POST" action="{{route('banners.update', $banner->id)}}"
                  enctype="multipart/form-data">
                @csrf
                @METHOD('PUT')
                <div class="section">
                    <div class="row">
                        <h4>Dados do Banner</h4>
                        <div class="divider"></div>
                        <div class="section">
                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">short_text</i>
                                <input required id="name" name="name" type="text" class="validate"
                                       value="{{$banner->name}}">
                                <label for="name">Nome</label>
                            </div>
                        </div>
                        <div class="section">
                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">sort</i>
                                <textarea id="Descrição" name="descricao" class="materialize-textarea"
                                          >{{$banner->description}}</textarea>
                                <label for="Descrição">Descrição</label>
                            </div>
                        </div>
                        <div class="col s12 m12 l12">
                            <div class="input-field col s12 m6 l8">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>IMAGEM</span>
                                        <input name="img" id="img" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input name="img" id="img" class="file-path validate" type="text" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m1 l2">
                                <img class="materialboxed"
                                     data-caption="Banner {{$banner->name}}"
                                     width=120" height="120"
                                     src="{{$banner->url}}">
                            </div>
                            <div class="switch" class="col s12 m2 l1">
                                <p>Apagar Imagem</p>
                                <label>
                                    Não
                                    <input type="checkbox" name="apagaImg">
                                    <span class="lever"></span>
                                    Sim
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fixed-action-btn">
                    <button type="submit" class="btn-floating btn-large">
                        <i class="large material-icons">add</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
