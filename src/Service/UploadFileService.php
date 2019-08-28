<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService
{
    public function upload(UploadedFile $file, $destination)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $originalFilename; //todo add more strong file renaming
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try
        {
            $file->move($destination, $fileName);
        }
        catch (FileException $e)
        {
            $response = 'failed to upload image: ' . $e->getMessage();
            //throw new FileException('Failed to upload file');
            return $response;
        }

        return $originalFilename." uploaded successfully";
    }
}