<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait UploadImageTrait
{

  public function uploadImage(Request $request, $inputName, $path)
  {
    if($request->hasFile($inputName)){

        $image = $request->{$inputName};
        $ext = $image->getClientOriginalExtension();
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $imageName =  'media_' . uniqid() . '-msflix-' . $day . '-' . $month . '-' . $year . '-.'. $ext;
        $image->move(public_path($path), $imageName);

        //caminho da pasta de imagens
        return $path .'/'. $imageName;

       }
  }

  public function updateImage(Request $request, $inputName, $path, $oldPath = null)
  {
    if($request->hasFile($inputName)){

        //Verifica se existe a imagem e apaga
        if(File::exists(public_path($oldPath))){
          File::delete(public_path($oldPath));
        }

        $image = $request->{$inputName};
        $ext = $image->getClientOriginalExtension();
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $imageName =  'media_' . uniqid() . '-msflix-' . $day . '-' . $month . '-' . $year . '-.'. $ext;
        $image->move(public_path($path), $imageName);

        //caminho da pasta de imagens
        return $path .'/'. $imageName;

       }
  }



}

