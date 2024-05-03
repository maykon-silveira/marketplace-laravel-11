<?php

namespace App\Traits;

use Illuminate\Http\Request;

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



}

