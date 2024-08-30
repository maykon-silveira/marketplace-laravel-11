<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendedor;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPerfilVendedorController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perfil = Vendedor::where('id_usuario', Auth::user()->id)->first();
        return view('admin.perfil-vendedor.index', compact('perfil'));
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
            'banner' => ['nullable', 'image', 'max:3000'],
            'fone' => ['required', 'max:70'],
            'email' => ['required', 'max:200'],
            'endereco' => ['required'],
            'descricao' => ['required'],
            'yt_link' => ['nullable', 'url'],
            'insta_link' => ['nullable', 'url'],
            'fb_link' => ['nullable', 'url'],
            'x_link' => ['nullable', 'url'],
        ]);

        $vendedor = Vendedor::where('id_usuario', Auth::user()->id)->first();
        $pastaBanner = $this->updateImage($request, 'banner', 'uploads', $vendedor->banner);
        $vendedor->banner = empty(!$pastaBanner) ? $pastaBanner : $vendedor->banner;
        $vendedor->fone = $request->fone;
        $vendedor->email = $request->email;
        $vendedor->endereco = $request->endereco;
        $vendedor->descricao = $request->descricao;
        $vendedor->yt_link = $request->yt_link;
        $vendedor->insta_link = $request->insta_link;
        $vendedor->fb_link = $request->fb_link;
        $vendedor->x_link = $request->x_link;
        $vendedor->save();


        toastr('Atualizado com sucesso!', 'success');

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
