<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoriaDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Str;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoriaDataTable $dataTable)
    {
        return $dataTable->render('admin/categoria/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //dd($request->all());
       $request->validate([
        'icone' => ['required', 'not_in:empty'],
        'nome' => ['required', 'max:200', 'unique:categorias,nome'],
        'status' => ['required']
       ]);

       $categoria = new Categoria();

       $categoria->icone = $request->icone;
       $categoria->nome = $request->nome;
       $categoria->status = $request->status;
       $categoria->slug = Str::slug($request->nome);
       $categoria->save();

       toastr('Cadastrado com sucesso!', 'success');
       return redirect()->route('categoria.index');
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
        $categoria = Categoria::findOrFail($id);
        return view('admin/categoria/edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'icone' => ['required', 'not_in:empty'],
            'nome' => ['required', 'max:200', 'unique:categorias,nome,'.$id],
            'status' => ['required']
           ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->icone = $request->icone;
        $categoria->nome = $request->nome;
        $categoria->status = $request->status;
        $categoria->slug = Str::slug($request->nome);
        $categoria->save();

        toastr("Atualizado com sucesso!", "success");
        return redirect()->route('categoria.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return response(['status' => 'success', 'message' => 'Excluído com sucesso!']);
    }


    public function mudaStatus(Request $request)
    {
       $categoria = Categoria::findOrFail($request->id);
       $categoria->status = $request->status == 'true' ? 1 : 0;
       $categoria->save();

       return response(['message' => 'Status atualizado com sucesso!']);
    }
}
