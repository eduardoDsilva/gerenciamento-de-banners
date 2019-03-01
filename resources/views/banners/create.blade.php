@extends('layouts.app')

@section('titulo', 'Cadastrar banner')

@section('breadcrumb')
    <a href="{{route('banners.index')}}" class="breadcrumb">Banners</a>
    <a href="{{route('banners.create')}}" class="breadcrumb">Cadastrar banner</a>
@endsection

@section('content')

    <div class="card-panel">
        <div class="row">
            <form class="col s12" method="POST" action="{{route('banners.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="section">
                    <div class="row">
                        <h4>Dados do Banner</h4>
                        <div class="divider"></div>
                        <div class="section">
                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">short_text</i>
                                <input required id="name" name="name" type="text" class="validate">
                                <label for="name">Nome</label>
                            </div>
                        </div>
                        <div class="section">
                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">sort</i>
                                <textarea id="description" name="description" class="materialize-textarea"
                                          ></textarea>
                                <label for="description">Descrição</label>
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
@endsection
