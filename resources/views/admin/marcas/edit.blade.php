@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Atualizar de Marcas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('marcas.index') }}">Listar</a></div>
            <div class="breadcrumb-item">Atualizar</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Atualizar Marca</h4>
                        <div class="card-header-action">
                            <a href="" class="btn btn-primary">Ajuda?</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('marcas.update', $marca->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Visualizar Logo</label>
                                <img src="{{ asset($marca->logo) }}" alt="{{ $marca->nome }}" style="width:150px; height:auto;">
                            </div>

                            <div class="form-group">
                                <label for="">Logo(600x360px)</label>
                                <input type="file" name="logo" placeholder="Add Logo" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Nome</label>
                                <input type="text" name="nome" placeholder="Add nome" class="form-control" value="{{ old('nome', $marca->nome)}}">
                            </div>

                            <div class="form-group">
                                <label for="">Destaque</label>
                                <select name="destacada" class="form-control">
                                    <option value="1" {{ $marca->destacada == 1 ? 'selected' : null}}>Sim</option>
                                    <option value="0" {{ $marca->destacada == 0 ? 'selected' : null}}>Não</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $marca->status == 1 ? 'selected' : null}}>Ativo</option>
                                    <option value="0" {{ $marca->status == 0 ? 'selected' : null}}>Cancelado</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
