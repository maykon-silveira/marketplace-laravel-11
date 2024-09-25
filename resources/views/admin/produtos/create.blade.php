@extends('admin.layouts.master')

@section('content')
<section class="section">
<div class="section-header">
<h1>Cadastro de Produto</h1>
<div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
<div class="breadcrumb-item active"><a href="{{ route('produtos.index') }}">Listar</a></div>
<div class="breadcrumb-item">Criar</div>
</div>
</div>

<div class="section-body">

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h4>Cadastrar Produto</h4>

<div class="card-header-action">
 <a href="" class="btn btn-primary">Ajuda?</a>
</div>

</div>

<div class="card-body">

<form action="{{ route('produtos.index') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
<label for="">Imagem(1200x1200px)</label>
<input type="file" name="capa" class="form-control" >
</div>

<div class="form-group">
<label for="">Título </label>
<input type="text" name="nome" class="form-control" placeholder="Adicione o titulo" value="{{old('nome')}}">
</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="">Categoria</label>
<select name="categoria_id" class="form-control categoria-chefe">
<option value="">Selecione</option>
@foreach ($categorias as $categoria)
<option value="{{$categoria->id}}">{{$categoria->nome}}</option>
@endforeach
</select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="">Sub-Categoria</label>
<select name="sub_categoria_id" class="form-control sub_categoria_id">
<option value="">Selecione</option>
</select>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<label for="">Categoria Filho</label>
<select name="filho_categoria_id" class="form-control filho_categoria_id">
<option value="">Selecione</option>
</select>
</div>
</div>

</div>


<div class="form-group">
<label for="">Marca</label>
<select name="id_marca" class="form-control">
<option value="">Selecione</option>
@foreach ($marcas as $marca)
<option value="{{$marca->id}}">{{$marca->nome}}</option>
@endforeach
</select>
</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="">Estoque</label>
<input type="number" name="qtd" class="form-control" placeholder="Adicione a QTD de estoque" value="{{ old('qtd') }}">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="">Valor</label>
<input type="text" name="valor" class="form-control" placeholder="Adicione o valor" value="{{ old('valor') }}">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="">Valor Oferta</label>
<input type="text" name="valor_oferta" class="form-control" placeholder="Adicione o valor da oferta" value="{{ old('valor_oferta') }}">
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label for="">Inicio da Oferta</label>
<input type="date" name="inicio_oferta" class="form-control" placeholder="Adicione a data" value="{{ old('inicio_oferta') }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="">Fim da Oferta</label>
<input type="date" name="fim_oferta" class="form-control" placeholder="Adicione a data" value="{{ old('inicio_oferta') }}">
</div>
</div>

</div>

<div class="form-group">
<label for="">Resumo</label>
<textarea name="descricao_curta" class="form-control" placeholder="Adicione um resumo"></textarea>
</div>

<div class="form-group">
<label for="">Descrição</label>
<textarea name="descricao_longa" class="form-control summernote" placeholder="Adicione a descrição"></textarea>
</div>


<div class="form-group">
<label for="">Vídeo</label>
<input type="text" name="video" class="form-control" placeholder="Adicione o vídeo" value="{{ old('video') }}">
</div>

<div class="form-group">
<label for="">Código de Barras</label>
<input type="text" name="codigo_barras" class="form-control" placeholder="Adicione o Código de Barras" value="{{ old('codigo_barras') }}">
</div>


<div class="form-group">
<label for="">Tipo de Produto</label>
<select name="tipo_produto" class="form-control">
<option value="novo">Novo</option>
<option value="top">Top</option>
<option value="destaque">Destaque</option>
<option value="melhor">Melhor</option>
</select>
</div>

<div class="form-group">
<label for="">Status</label>
<select name="status" class="form-control">
<option value="1">Ativo</option>
<option value="0">Cancelado</option>
</select>
</div>
<div class="row">

<div class="col-md-6">
<div class="form-group">
<label for="">Seo Titulo</label>
<input type="text" name="google_titulo" class="form-control" placeholder="Adicione seo titulo" value="{{ old('google_titulo') }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="">Seo Descrição</label>
<input type="text" name="google_descricao" class="form-control" placeholder="Adicione Seo Descrição" value="{{ old('google_descricao') }}">
</div>
</div>

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

@push('scripts')
 <script>
$(document).ready(function(){

//chama as sub-categorias ligadas as categorias
$('body').on('change', '.categoria-chefe', function(m){
 //alert('Sou Aluno da EAD MAykonSilveira.com.br');
 let id = $(this).val();
 ///console.log(id);
 $.ajax({
method: 'GET',
url: "{{ route('produtos.get-subCategorias') }}",
data: {
id:id
},
success: function(data){
$('.sub_categoria_id').html('<option value="">Selecione</option>');

$.each(data, function(i, item){
$('.sub_categoria_id').append(`<option value="${item.id}">${item.nome}</option>`);
});
},
error: function(xhr, status, error){
console.log(error);
}
 })

})

//chama as categorias filhos ligadas as sub-categorias
$('body').on('change', '.sub_categoria_id', function(m){
 //alert('Sou Aluno da EAD MAykonSilveira.com.br');
 let id = $(this).val();
 ///console.log(id);
 $.ajax({
method: 'GET',
url: "{{ route('produtos.get-filhoCategorias') }}",
data: {
id:id
},
success: function(data){
$('.filho_categoria_id').html('<option value="">Selecione</option>');

$.each(data, function(i, item){
$('.filho_categoria_id').append(`<option value="${item.id}">${item.nome}</option>`);
});
},
error: function(xhr, status, error){
console.log(error);
}
 })

})


})
 </script>
@endpush
