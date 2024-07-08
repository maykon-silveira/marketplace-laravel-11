<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoriaFilhoDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class CategoriaFilhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoriaFilhoDataTable $dataTable)
    {
        return $dataTable->render('admin.categoria-filho.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categorias = Categoria::all();
       return view('admin.categoria-filho.create', compact('categorias'));
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
    public function getSubCategorias(Request $request)
    {
        $subcategorias = SubCategoria::where('id_categoria', $request->id)->where('status', 1)->get();
        return $subcategorias;
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
