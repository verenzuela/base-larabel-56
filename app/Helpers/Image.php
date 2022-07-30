<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use File;
use Storage;

class Image
{

	static function upload(Request $request, $pathStorage, $inputName){
		$extension = strtolower( File::extension( $request->file($inputName)->getClientOriginalName() ) );
    $fileName = round(microtime(true)) . '.' . $extension;
    $storage = Storage::putFileAs( $pathStorage, $request->file($inputName), $fileName );
    
    $metaData = [
      'storage_folder' => storage_path($storage), 
      'img_path' => $storage, 
      'img_url' => Storage::url($storage),
      'fileName' => $fileName, 
      'extension' => $extension
    ];

    return $metaData;
	}

	static function storageDelete($imagePath){
		Storage::delete($imagePath);
	}

  static function getEmptyImage($w='-', $h='-'){
    return route('assets.image', ['w'=>$w, 'h'=>$h, 'imagePath'=> 'images/blank.png' ]);
  }

}