@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Cadastro de slide</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('slider.index') }}">Listar</a></div>
        <div class="breadcrumb-item">Criar</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Criar Slide</h4>

              <div class="card-header-action">
               <a href="" class="btn btn-primary">Ajuda?</a>
              </div>

            </div>

            <div class="card-body">

                <form action="" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="">Imagem(1300x500px)</label>
                    <input type="file" name="" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="">Titulo 1</label>
                    <input type="text" name="" class="form-control" placeholder="Adicione o titulo">
                  </div>

                  <div class="form-group">
                    <label for="">Titulo 2</label>
                    <input type="text" name="" class="form-control" placeholder="Adicione o titulo">
                  </div>

                  <div class="form-group">
                    <label for="">Link</label>
                    <input type="url" name="" class="form-control" placeholder="Adicione o link">
                  </div>

                  <div class="form-group">
                    <label for="">Ordem</label>
                    <input type="number" name="" class="form-control" placeholder="Adicione a ordem de exibição">
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
