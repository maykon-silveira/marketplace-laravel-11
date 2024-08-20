<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">MSFLIX</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">MS</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Painel</li>
        <li class="dropdown {{ ativadorLinks([
        'slider.*'
        ]) }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Painel</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="index-0.html">Configurações</a></li>
            <li class="{{ ativadorLinks(['slider.*']) }}"><a class="nav-link" href="{{ route('slider.index') }}">Slide Destaque</a></li>
          </ul>
        </li>

        <li class="menu-header">Categorias</li>
        <li class="dropdown {{ ativadorLinks([
        'categoria.*',
        'sub-categoria.*',
        'categoria-filho.*'
        ]) }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Gerencie Categorias</span></a>
          <ul class="dropdown-menu">
            <li class="{{ ativadorLinks(['categoria.*']) }}"><a class="nav-link" href="{{ route('categoria.index')}}">Categorias</a></li>
            <li class="{{ ativadorLinks(['sub-categoria.*']) }}"><a class="nav-link" href="{{ route('sub-categoria.index')}}">Sub-Categorias</a></li>
            <li class="{{ ativadorLinks(['categoria-filho.*']) }}"><a class="nav-link" href="{{ route('categoria-filho.index')}}">Categoria Filho</a></li>
          </ul>
        </li>

        <li class="menu-header">Produtos</li>
        <li class="dropdown {{ ativadorLinks([
        'marcas.*'
        ]) }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Gerenciar Produtos</span></a>
          <ul class="dropdown-menu">
            <li class="{{ ativadorLinks(['marcas.*']) }}"><a class="nav-link" href="{{ route('marcas.index')}}">Marcas</a></li>

          </ul>
        </li>

        <li class="menu-header">Lojas</li>
        <li class="dropdown {{ ativadorLinks([
        'vendedor-perfil.*'
        ]) }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Vendedores</span></a>
          <ul class="dropdown-menu">
            <li class="{{ ativadorLinks(['vendedor-perfil.*']) }}"><a class="nav-link" href="{{ route('vendedor-perfil.index')}}">Perfil do Vendedor</a></li>

          </ul>
        </li>
        <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
    </ul>

    </aside>
  </div>
