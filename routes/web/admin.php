<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminPerfilVendedorController;
use App\Http\Controllers\Backend\CategoriaController;
use App\Http\Controllers\Backend\CategoriaFilhoController;
use App\Http\Controllers\Backend\MarcaController;
use App\Http\Controllers\Backend\ProdutoController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoriaController;
use Illuminate\Support\Facades\Route;

//rota admin
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])
->middleware(['auth', 'admin'])
->name('admin.dashboard');

/** Rota admin ver perfil  */
Route::get('admin/profile', [ProfileController::class, 'index'])
->middleware(['auth', 'admin'])
->name('admin.profile');

/** Rota admin para atualizar o perfil   */
Route::post('admin/profile/update', [ProfileController::class, 'update'])
->middleware(['auth', 'admin'])
->name('admin.profile.update');

/** Rota admin para atualizar a senha   */
Route::post('admin/profile/update/password', [ProfileController::class, 'updatePassword'])
->middleware(['auth', 'admin'])
->name('admin.profile.password');

/** Rota slider destaque   */
Route::resource('admin/slider', SliderController::class)
->middleware(['auth', 'admin']);


/** Rota categoria pai */
Route::put('muda-status', [CategoriaController::class, 'mudaStatus'])->name('categoria.muda-status');
Route::resource('admin/categoria', CategoriaController::class)
->middleware(['auth', 'admin']);

/** Rota categoria sub-categoria  */
Route::put('subcategoria/muda-status', [SubCategoriaController::class, 'mudaStatus'])->name('sub-categoria.muda-status');
Route::resource('admin/sub-categoria', SubCategoriaController::class)
->middleware(['auth', 'admin']);

/** Rota categoria filho  */
Route::put('categoria-filho/muda-status', [CategoriaFilhoController::class, 'mudaStatus'])->name('categoria-filho.muda-status');
Route::get('get-subcategorias', [CategoriaFilhoController::class, 'getSubCategorias'])->name('get-subcategorias');
Route::resource('admin/categoria-filho', CategoriaFilhoController::class)
->middleware(['auth', 'admin']);


/** Rota marcas */
Route::put('marcas/muda-status', [MarcaController::class, 'mudaStatus'])->name('marcas.muda-status');
Route::resource('admin/marcas', MarcaController::class)
->middleware(['auth', 'admin']);


//Perfil do vendedor
Route::resource('vendedor-perfil', AdminPerfilVendedorController::class)
->middleware(['auth', 'admin']);


//Produtos
Route::resource('produtos', ProdutoController::class)
->middleware(['auth', 'admin']);


