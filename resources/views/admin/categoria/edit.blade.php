@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Cadastro de Categoria</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('categoria.index') }}">Listar</a></div>
        <div class="breadcrumb-item">Criar</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Atualizar Categoria</h4>

              <div class="card-header-action">
               <a href="" class="btn btn-primary">Ajuda?</a>
              </div>

            </div>

            <div class="card-body">

                <form action="{{ route('categoria.update', $categoria->id) }}" method="post" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')
                  <div class="form-group">
                   <div>
                     <button
                     style="text-align: left; width:100%; padding:15px;"
                     class="btn btn-primary"
                     data-selected-class="btn-danger"
                     data-unselected-class="btn-primary"
                     data-iconset="fontawesome5"
                     data-icon="{{ $categoria->icone }}"
                     role="iconpicker"
                     data-rows="5"
                     data-cols="7"
                     name="icone"

                     ></button>
                   </div>
                  </div>

                  <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" name="nome" placeholder="Add nome da categoria" class="form-control" value="{{ old('nome', $categoria->nome)}}">
                  </div>


                  <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $categoria->status == 1 ? 'selected' : null }}>Ativo</option>
                        <option value="0"  {{ $categoria->status == 0 ? 'selected' : null }}>Cancelado</option>
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
