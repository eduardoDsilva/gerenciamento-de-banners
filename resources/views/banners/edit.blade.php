@extends('layouts.app')

@section('titulo', 'Editar banner')

@section('content')
    <div class="container">
        <div class="card-panel">
            <div class="row">
                <form class="col s12" method="POST" action="{{route('banners.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="section">
                        <div class="row">
                            <h4>Dados do Banner</h4>
                            <div class="divider"></div>
                            <div class="section">
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">location_on</i>
                                    <input required id="name" name="name" type="text" class="validate" value="{{$banner->name}}">
                                    <label for="name">Nome</label>
                                </div>
                            </div>
                            <div class="section">
                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">location_on</i>
                                    <textarea id="Descrição" name="descricao" class="materialize-textarea" required>{{$banner->description}}</textarea>
                                    <label for="Descrição">Descrição</label>
                                </div>
                            </div>
                            <div class="input-field col s12 m12 l12">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>BANNER</span>
                                        <input name="img" id="img" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input name="img" id="img" class="file-path validate" type="text">
                                    </div>
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
    </div>
@endsection
