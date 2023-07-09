<?php

namespace App\Http\Services\Upload;

use Exception;

class UploadService{
    public function store($request){
        if($request->hasFile('file')){ //kiem tra file co ton tai hay khong
           try{
                $name = $request->file('file')->getClientOriginalName(); // lay ten tep
                $pathFull = '/uploads/' . date("Y/m/d"); 
                $path = $request->file('file')->storeAs( //storeAss co 2 doi so
                    'public'. $pathFull, $name //thu muc luu file : uploads/nam/thang/ngay/ten file
                );

                return '/storage/'.$pathFull.'/'.$name ; 
            }catch(\Exception){
                return false ; 
            }
        }
    }
}