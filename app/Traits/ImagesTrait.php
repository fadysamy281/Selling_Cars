<?php

namespace App\Traits;
//use App\Models\Product;


trait ImagesTrait
{
    public function saveImage($file_name,$photo,$path){
        $file_extension=$photo->getClientOriginalExtension();
        $file_name=$file_name.'.'.$file_extension;
        $photo->move($path,$file_name);
    }


}
