<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProdutoDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\CategoriaFilho;
use App\Models\Marca;
use App\Models\Produto;
use App\Models\SubCategoria;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class ProdutoController extends Controller
{

    use UploadImageTrait;
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



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //dd($request->all());
       $request->validate([
        'capa' => ['required', 'image', 'max:3000'],
        'nome' => ['required', 'max:200'],
        'categoria_id' => ['required'],
        'id_marca' => ['required'],
        'valor' => ['required'],
        'qtd' => ['required'],
        'descricao_curta' => ['required', 'max:600'],
        'descricao_longa' => ['required'],
        'google_titulo' => ['nullable', 'max:200'],
        'google_descricao' => ['nullable'],
        'status' => ['required'],
       ]);

       $pastaProdutos = $this->uploadImage($request, 'capa', 'uploads');

       $produto = new Produto();
       $produto->capa = $pastaProdutos;
       $produto->nome = $request->nome;
       $produto->slug = Str::slug($produto->nome);
       $produto->categoria_id = $request->categoria_id;
       $produto->sub_categoria_id = $request->sub_categoria_id;
       $produto->filho_categoria_id = $request->filho_categoria_id;
       $produto->id_marca = $request->id_marca;
       $produto->valor = $request->valor;
       $produto->valor_oferta = $request->valor_oferta;
       $produto->video = $request->video;
       $produto->qtd = $request->qtd;
       $produto->descricao_curta = $request->descricao_curta;
       $produto->descricao_longa = $request->descricao_longa;
       $produto->google_titulo = $request->google_titulo;
       $produto->google_descricao = $request->google_descricao;
       $produto->status = $request->status;
       $produto->id_vendedor = Auth::user()->id;
       $produto->codigo_barras = $request->codigo_barras;
       $produto->inicio_oferta = $request->inicio_oferta;
       $produto->fim_oferta = $request->fim_oferta;
       $produto->tipo_produto = $request->tipo_produto;
       $produto->aprovado = 1;
       $produto->save();

       toastr('Produto cadastrado com sucesso!', 'success');

       return redirect()->route('produtos.index');
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
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $subCategorias = SubCategoria::where('id_categoria', $produto->categoria_id)->get();
        $categoriaFilhos = CategoriaFilho::where('sub_categoria_id', $produto->sub_categoria_id)->get();
        return view('admin.produtos.edit', compact('produto', 'categorias', 'marcas', 'subCategorias', 'categoriaFilhos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       //dd($request->all());
       $request->validate([
        'capa' => ['nullable', 'image', 'max:3000'],
        'nome' => ['required', 'max:200'],
        'categoria_id' => ['required'],
        'id_marca' => ['required'],
        'valor' => ['required'],
        'qtd' => ['required'],
        'descricao_curta' => ['required', 'max:600'],
        'descricao_longa' => ['required'],
        'google_titulo' => ['nullable', 'max:200'],
        'google_descricao' => ['nullable'],
        'status' => ['required'],
       ]);

       $produto = Produto::findOrFail($id);

       $pastaProduto = $this->updateImage($request, 'capa', 'uploads', $produto->capa);

       $produto->capa = empty(!$pastaProduto) ? $pastaProduto : $produto->capa;
       $produto->nome = $request->nome;
       $produto->slug = Str::slug($produto->nome);
       $produto->categoria_id = $request->categoria_id;
       $produto->sub_categoria_id = $request->sub_categoria_id;
       $produto->filho_categoria_id = $request->filho_categoria_id;
       $produto->id_marca = $request->id_marca;
       $produto->valor = $request->valor;
       $produto->valor_oferta = $request->valor_oferta;
       $produto->video = $request->video;
       $produto->qtd = $request->qtd;
       $produto->descricao_curta = $request->descricao_curta;
       $produto->descricao_longa = $request->descricao_longa;
       $produto->google_titulo = $request->google_titulo;
       $produto->google_descricao = $request->google_descricao;
       $produto->status = $request->status;
       $produto->id_vendedor = Auth::user()->id;
       $produto->codigo_barras = $request->codigo_barras;
       $produto->inicio_oferta = $request->inicio_oferta;
       $produto->fim_oferta = $request->fim_oferta;
       $produto->tipo_produto = $request->tipo_produto;
       $produto->aprovado = 1;
       $produto->save();

       toastr('Produto atualizado com sucesso!', 'success');

       return redirect()->route('produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);

        $this->deleteImage($produto->capa);

        $produto->delete();

        return response(['status' => 'success', 'message' => 'Excluído com sucesso!']);
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

     public function mudaStatus(Request $request)
     {
        $produto = Produto::findOrFail($request->id);
        $produto->status = $request->status == 'true' ? 1 : 0;
        $produto->save();

        return response(['message' => 'Status atualizado com sucesso!']);
     }
}
