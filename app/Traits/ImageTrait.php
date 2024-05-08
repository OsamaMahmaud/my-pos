<?php

namespace App\Traits;

Trait  ImageTrait
{

    function saveImage($photo,$folder)
    {
      $file_extension = $photo ->getClientOriginalExtension();
      $file_name =time().'.'.$file_extension;
      $file_path =$folder;
      $photo->move($file_path,$file_name);
      return $file_name;
    }

}
