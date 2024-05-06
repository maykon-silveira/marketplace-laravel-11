<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\DataTables\SliderDataTable;
use App\Models\Slider;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    //envio de imagem msflix Maykon Silveira
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        //return view('admin/slider/index');
        return $dataTable->render('Admin/slider/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/slider/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
         'banner' => ['required', 'image', 'max:2048'],
         'titulo' => ['string', 'max:200'],
         'title_two' => ['required', 'max:200'],
         'starting_price' => ['max:200'],
         'link' => ['url'],
         'serial' => ['required', 'integer'],
         'status' => ['required'],
        ]);

        $slider = new Slider();

        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        $slider->banner = $imagePath;
        $slider->titulo = $request->titulo;
        $slider->title_two = $request->title_two;
        $slider->starting_price = $request->starting_price;
        $slider->link = $request->link;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        toastr()->success('Cadastrado com sucesso!');
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
