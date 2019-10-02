<?php


namespace App\Service;

use DateTime;
use FilesystemIterator;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService
{
    const PATH = "http://ishtar-art.de/ImageUploads/";
    const ARTISTIMAGEPATH = '/../ImageUploads/ArtistImages/';
    const PANTINGIMAGEPATH = '/../ImageUploads/PaintingImages/';
    private $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $originalFilename; //todo add more strong file renaming
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try
        {
            $file->move($this->Destination(), $fileName);
        }
        catch (FileException $e)
        {
            $response = 'failed to upload image: ' . $e->getMessage();
            //throw new FileException('Failed to upload file');
            return $response;
        }

        return self::PATH.$this->GetFilesAndFolder($this->rootPath.self::ARTISTIMAGEPATH).$fileName;
    }

    public function GetFilesAndFolder($directory) {
        /*file want to be escaped*/
        $EscapedFiles = [
            '.',
            '..'
        ];

        $FilesAndFolders = [];
        /*Scan Files and Directory*/
        $FilesAndDirectoryList = scandir($directory);
        foreach ($FilesAndDirectoryList as $SingleFile) {
            if (in_array($SingleFile, $EscapedFiles)){
                continue;
            }
            /*Store the Files with Modification Time to an Array*/
            $FilesAndFolders[$SingleFile] = filemtime($directory . '/' . $SingleFile);
        }
        /*Sort the result*/
        arsort($FilesAndFolders);
        $FilesAndFolders = array_keys($FilesAndFolders);

        return $directory.reset($FilesAndFolders);
    }

    public function CountFiles($directoryPath)
    {
        $fi = new FilesystemIterator($this->GetFilesAndFolder($directoryPath), FilesystemIterator::SKIP_DOTS);
        return iterator_count($fi);
    }

    public function Destination()
    {
        //todo: if there is no folder

        $count = $this->CountFiles($this->rootPath.self::ARTISTIMAGEPATH);

        if ($count >= 4)
        {
            $datetime = new DateTime();
            $folderName = $datetime->format('Y-m-d H:i:s');
            $destination = $this->rootPath.self::ARTISTIMAGEPATH.$folderName;
            return $destination;
        }
        else
        {
            return $this->GetFilesAndFolder($this->rootPath.self::ARTISTIMAGEPATH);
        }
    }
}