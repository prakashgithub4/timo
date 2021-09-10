<?php

namespace App\Traits;
use Maatwebsite\Excel\Facades\Excel;

trait ImageTraits
{
    public function Uploadfile($file,$location)
    {
        $image = $file;
        $data['file'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($location);
        $image->move($destinationPath, $data['file']);
        return $data;
    }
    public function uploadcsv($model,$file)
    {
        Excel::import($model,$file);
        return true;
    }
    
}
