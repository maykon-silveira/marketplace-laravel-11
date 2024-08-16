<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\MarcasDataTable;
use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Str;

class MarcaController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(MarcasDataTable $dataTable)
    {
        return $dataTable->render('admin.marcas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
          'logo' => ['image', 'required', 'max:2000'],
          'nome' => ['required', 'max:200'],
          'destacada' => ['required'],
          'status' => ['required'],
        ]);

        $logoPasta = $this->uploadImage($request, 'logo', 'uploads');
        $marca = new Marca();

        $marca->logo = $logoPasta;
        $marca->nome = $request->nome;
        $marca->destacada = $request->destacada;
        $marca->status = $request->status;
        $marca->slug = Str::slug($request->nome);
        $marca->save();

        toastr('Cadastrada com sucesso', 'success');
        return redirect()->route('marcas.index');

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
        $marca = Marca::findOrFail($id);
        return view('admin.marcas.edit', compact('marca'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
          'logo' => ['image', 'max:2000'],
          'nome' => ['required', 'max:200'],
          'destacada' => ['required'],
          'status' => ['required'],
        ]);

        $marca = Marca::findOrFail($id);

        $logoPasta = $this->uploadImage($request, 'logo', 'uploads', $marca->logo);

        $marca->logo = empty(!$logoPasta) ? $logoPasta : $marca->logo;
        $marca->nome = $request->nome;
        $marca->slug = Str::slug($request->nome);
        $marca->destacada = $request->destacada;
        $marca->status = $request->status;
        $marca->save();

        toastr('Atualizado com sucesso!', 'success');
        return redirect()->route('marcas.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);
        $this->deleteImage($marca->logo);
        $marca->delete();

        return response(['status' => 'success', 'message' => 'Excluido com sucesso!']);
    }

    public function mudaStatus(Request $request)
    {
       $marca = Marca::findOrFail($request->id);
       $marca->status = $request->status == 'true' ? 1 : 0;
       $marca->save();

       return response(['message' => 'Status atualizado com sucesso!']);
    }
}
