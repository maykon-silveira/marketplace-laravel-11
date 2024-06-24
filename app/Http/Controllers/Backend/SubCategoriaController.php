<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoriaDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;
use Str;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoriaDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.sub-categoria.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'id_categoria' => ['required'],
            'nome' => ['required', 'max:200', 'unique:sub_categorias,nome'],
            'status' => ['required'],
        ]);

        $subcategorias = new SubCategoria();
        $subcategorias->id_categoria = $request->id_categoria;
        $subcategorias->nome = $request->nome;
        $subcategorias->status = $request->status;
        $subcategorias->slug = Str::slug($request->nome);
        $subcategorias->save();


        toastr('SubCategoria cadstrada com sucesso!', 'success');
        return redirect()->route('sub-categoria.index');

    }

    public function mudaStatus(Request $request)
    {
       $subCategoria = SubCategoria::findOrFail($request->id);
       $subCategoria->status = $request->status == 'true' ? 1 : 0;
       $subCategoria->save();

       return response(['message' => 'Status atualizado com sucesso!']);
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
        $categorias = Categoria::all();
        $subCategoria = SubCategoria::findOrFail($id);
        return view('admin.sub-categoria.edit', compact('subCategoria', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'id_categoria' => ['required'],
            'nome' => ['required', 'max:200', 'unique:sub_categorias,nome,'.$id],
            'status' => ['required'],
        ]);

        $subcategorias = SubCategoria::findOrFail($id);
        $subcategorias->id_categoria = $request->id_categoria;
        $subcategorias->nome = $request->nome;
        $subcategorias->status = $request->status;
        $subcategorias->slug = Str::slug($request->nome);
        $subcategorias->save();


        toastr('SubCategoria atualizada com sucesso!', 'success');
        return redirect()->route('sub-categoria.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
