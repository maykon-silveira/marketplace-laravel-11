@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Cadastro de Sub-Categoria</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('sub-categoria.index') }}">Listar</a></div>
        <div class="breadcrumb-item">Criar</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Criar Sub-Categoria</h4>

              <div class="card-header-action">
               <a href="" class="btn btn-primary">Ajuda?</a>
              </div>

            </div>

            <div class="card-body">

                <form action="{{ route('sub-categoria.store') }}" method="post" enctype="multipart/form-data">
                 @csrf

                 <div class="form-group">
                    <label for="">Categoria</label>
                    <select name="id_categoria" class="form-control">
                        @foreach ($categorias as $categoria)
                           <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" name="nome" placeholder="Add nome da categoria" class="form-control">
                  </div>


                  <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Ativo</option>
                        <option value="0">Cancelado</option>
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
