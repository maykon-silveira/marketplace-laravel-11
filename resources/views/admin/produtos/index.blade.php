@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Todos os Produtos</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
        <div class="breadcrumb-item">Produto</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Todos os Produtos</h4>

              <div class="card-header-action">
               <a href="{{ route('produtos.create') }}" class="btn btn-primary"> <i class="fas fa-plus"></i> Novo</a>
              </div>

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
@endpush
