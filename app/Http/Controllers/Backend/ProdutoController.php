<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProdutoDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\CategoriaFilho;
use App\Models\Marca;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProdutoDataTable $dataTable)
    {
        return $dataTable->render('Admin.produtos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('admin.produtos.create', compact('categorias', 'marcas'));
    }

    //chamada da sub-categoria
    public function getSubCategorias(Request $request)
    {
       $subCategoria = SubCategoria::where('id_categoria', $request->id)->get();

       return $subCategoria;
    }

    //chamada da categoria filho
    public function getCategoriasFilho(Request $request)
    {
       $categoriaFilho = CategoriaFilho::where('sub_categoria_id', $request->id)->get();

       return $categoriaFilho;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
