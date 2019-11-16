<?php
namespace App\Core;

class UploadFile{

  /**
   * Upload image of files
   * @param  [type] $file     $_FILES["yourFile"]
   * @param  [type] $typeFile  'i' or 'f', where i == image and f == file
   * @return [type]          -1 = invalid mimetype, -10 = size is larges, -100 = error on upload and file_name = When uploded image
   */
  public function upload($file, $typeFile){
    if($this->validateType($file["type"])){
      if($this->validateSize($file["size"], $typeFile)){
        $explode = explode(".", $file["name"]);
        $fileName = "";
        $fullDirectory = "";

        if(RENAME_FILE){
          $fileName = md5($explode[0] . "" . date("YmdHis")) . ".".$explode[1];
        }else{
          $fileName = $explode[0] . "." . $explode[1];
        }

        if($typeFile == "i"){
          $fullDirectory = IMAGE_PATH . "/" . $fileName;
        }else{
          $fullDirectory = FILE_PATH . "/" . $fileName;
        }

        if(move_uploaded_file($file['tmp_name'], $fullDirectory)){
          return $fileName;
        }else{
          return -100;
        }
      }else{
        return -10; //Invalid file size
      }
    }else{
      return -1; //Invalid mimetype
    }
  }

  private function validateType($mimeType){
    $valid = false;
    foreach(ACCEPT_FORMAT as $f){
      if($f == $mimeType)
      $valid = true;
    }
    return $valid;
  }

  private function validateSize($size, $fileType){
    if($fileType == "f" && $size <= ((MAX_FILE_SIZE * 1024) * 1024)){
      return true;
    }elseif($fileType == "i" && $size <= ((MAX_IMAGE_SIZE * 1024) * 1024)){
      return true;
    }else{
      return false;
    }
  }
}
