<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProdutoGaleriasImgDataTable;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\ProdutoGaleriaImg;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class ProdutoGaleriasImgController extends Controller
{

    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProdutoGaleriasImgDataTable $dataTable)
    {
        $produto = Produto::findOrFail($request->produto);
        return $dataTable->render('admin.produtos.galerias-img.index', compact('produto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'imagem.*' => ['required', 'image', 'max:3048'],
        ]);

        //pasta das galerias
        $imagensGalerias = $this->uploadGalleryImages($request, 'imagem', 'uploads');

        foreach($imagensGalerias as $pasta){
         $produtoGaleria = new ProdutoGaleriaImg();
         $produtoGaleria->imagem = $pasta;
         $produtoGaleria->id_produto = $request->id_produto;
         $produtoGaleria->save();
        }

        toastr('Galeria cadastrada com sucesso!', 'success');

        return redirect()->back();

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
