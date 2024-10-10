@extends('admin.layouts.master')

@section('content')
<section class="section">
<div class="section-header">
<h1>Galerias de Imagens de Produtos</h1>
<div class="section-header-breadcrumb">
<div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
<div class="breadcrumb-item">Galerias</div>
</div>
</div>

<div class="section-body">

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
  <h4>Enviar Imagens</h4>
</div>

<div class="card-body">

<form action="{{ route('produtos-galerias-img.store') }}" enctype="multipart/form-data">

<div class="form-group">
<label for="">Selecione as Imagens <code>(Suporta Várias Imagens)</code> </label>
<input type="file" name="" id="" multiple class="form-control">
</div>

<button type="submit" class="btn btn-primary">Enviar Imagens</button>
</form>

</div>

</div>
</div>

</div>


<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
  <h4>Todas as Galerias</h4>
</div>

<div class="card-body">
  {{ $dataTable->table() }}
</div>

</div>
</div>

</div>

</div>
  </section>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
$(document).ready(function(){
$('body').on('click', '.muda-status', function(){
let checando = $(this).is(':checked');
let id = $(this).data('id');

$.ajax({
 url: "{{route('produtos.muda-status')}}",
 method: 'PUT',
 data: {
 status: checando,
 id: id
 },
 success: function(data){
 toastr.success(data.message);
 },
 error: function(xhr, status, error){
console.log(error);
 }
})
})
});
</script>
@endpush
