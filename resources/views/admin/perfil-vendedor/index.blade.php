@extends('admin.layouts.master')

@section('content')
<section class="section">
<div class="section-header">
<h1>Perfil do Vendedor</h1>
<div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
<div class="breadcrumb-item active"><a href="{{ route('vendedor-perfil.index') }}">Listar</a></div>
<div class="breadcrumb-item">Criar</div>
</div>
</div>

<div class="section-body">

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h4>Perfil do Vendedor</h4>

<div class="card-header-action">
 <a href="" class="btn btn-primary">Ajuda?</a>
</div>

</div>

<div class="card-body">

<form action="{{ route('vendedor-perfil.store') }}" method="post" enctype="multipart/form-data">
 @csrf
<div class="form-group">
<label for="">Imagem(1920x500px)</label>
<input type="file" name="banner" class="form-control" >
</div>

<div class="form-group">
<label for="">Whatsapp</label>
<input type="text" name="fone" class="form-control" placeholder="Adicione o Whatsapp" value="{{old('fone')}}">
</div>

<div class="form-group">
<label for="">E-mail</label>
<input type="email" name="email" class="form-control" placeholder="Adicione o e-mail" value="{{ old('email') }}">
</div>

<div class="form-group">
<label for="">Endereço</label>
<input type="text" name="endereco" class="form-control" placeholder="Adicione o endereço com número" value="{{ old('endereco') }}">
</div>

<div class="form-group">
<label for="">Youtube</label>
<input type="url" name="yt_link" class="form-control" placeholder="Adicione url da rede social" value="{{ old('yt_link') }}">
</div>

<div class="form-group">
<label for="">Instagram</label>
<input type="url" name="insta_link" class="form-control" placeholder="Adicione url da rede social" value="{{ old('insta_link') }}">
</div>

<div class="form-group">
<label for="">Facebook</label>
<input type="url" name="fb_link" class="form-control" placeholder="Adicione url da rede social" value="{{ old('fb_link') }}">
</div>


<div class="form-group">
<label for="">X</label>
<input type="url" name="x_link" class="form-control" placeholder="Adicione url da rede social" value="{{ old('x_link') }}">
</div>

<div class="form-group">
<label for="">Descrição</label>
<textarea type="text" name="descricao" class="summernote"></textarea>
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
