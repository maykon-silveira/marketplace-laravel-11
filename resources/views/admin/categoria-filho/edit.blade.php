@extends('admin.layouts.master')

@section('content')
<section class="section">
<div class="section-header">
<h1>Atualizar Categoria Filho</h1>
<div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
<div class="breadcrumb-item active"><a href="{{ route('categoria-filho.index') }}">Listar</a></div>
<div class="breadcrumb-item">Criar</div>
</div>
</div>

<div class="section-body">

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h4>Atualizar Categoria Filho</h4>

<div class="card-header-action">
 <a href="" class="btn btn-primary">Ajuda?</a>
</div>

</div>

<div class="card-body">

<form action="{{ route('categoria-filho.update', $categoriaFilho->id) }}" method="post" enctype="multipart/form-data">
 @csrf
 @method('PUT')
 <div class="form-group">
<label for="">Categoria</label>
<select name="id_categoria" class="form-control categoria-chefe">
@foreach ($categorias as $categoria)
 <option value="{{ $categoria->id }}" {{ $categoria->id == $categoriaFilho->id_categoria ? 'selected' : null}}>{{ $categoria->nome }}</option>
@endforeach
</select>
</div>

 <div class="form-group">
<label for="">Sub-Categoria</label>
<select name="sub_categoria_id" class="form-control categoria-gerente">
    @foreach ($subCategorias as $subCategoria)
     <option value="{{ $subCategoria->id }}" {{ $subCategoria->id == $categoriaFilho->sub_categoria_id ? 'selected' : null}}>{{ $subCategoria->nome }}</option>
    @endforeach
    </select>
</div>

<div class="form-group">
<label for="">Nome</label>
<input type="text" name="nome" placeholder="Add nome da categoria" class="form-control" value="{{ old('nome', $categoriaFilho->nome) }}">
</div>


<div class="form-group">
<label for="">Status</label>
<select name="status" class="form-control">
<option value="1" {{ $categoriaFilho->status == 1 ? 'selected' : null }}>Ativo</option>
<option value="0" {{ $categoriaFilho->status == 0 ? 'selected' : null }}>Cancelado</option>
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
@push('scripts')
 <script>
$(document).ready(function(){
$('body').on('change', '.categoria-chefe', function(m){
 //alert('Sou Aluno da EAD MAykonSilveira.com.br');
 let id = $(this).val();
 ///console.log(id);
 $.ajax({
method: 'GET',
url: "{{ route('get-subcategorias') }}",
data: {
id:id
},
success: function(data){
$('.categoria-gerente').html('<option value="">Selecione</option>');

$.each(data, function(i, item){
$('.categoria-gerente').append(`<option value="${item.id}">${item.nome}</option>`);
})
},
error: function(xhr, status, error){
console.log(error);
}
 })

})
})
 </script>
@endpush
