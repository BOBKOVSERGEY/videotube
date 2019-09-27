<?php


class VideoProcessor
{
    private $sizeLimit = 500000000; // 4.5gb
    private $allowedTypes = [
            'mp4',
            'flv',
            'webm',
            'mkv',
            'vob',
            'ogv',
            'ogg',
            'avi',
            'wmv',
            'mov',
            'mpeg',
            'mpg'
    ];

    //private $ffmpegPath;
    // for windows
    private $ffmpegPath;

    public function __construct()
    {
        // for windows
       $this->ffmpegPath = realpath('ffmpeg/bin/ffmpeg.exe');
    }

    public function upload($videoUploadData)
    {
        $targetDir = 'uploads/videos/';
        $videoData = $videoUploadData->videoDataArray;
        $tempFilePath = $targetDir . uniqid() . basename($videoData['name']);

        $tempFilePath = str_replace(' ', '_', $tempFilePath);
        $isValidData = $this->processData($videoData, $tempFilePath);
        if (!$isValidData) {
            return false;
        }

        if (move_uploaded_file($videoData['tmp_name'], $tempFilePath)) {
            $finalFilePath = $targetDir . uniqid() . '.mp4';

            if (!$this->insertVideoData($videoUploadData, $finalFilePath)) {
                echo 'Insert query failed';
                return false;
            }

            if (!$this->convertVideoToMp4($tempFilePath, $finalFilePath)) {
                echo 'Upload failed';
                return false;
            }

            if (!$this->deleteFile($tempFilePath)) {
                echo 'Upload failed';
                return false;
            }
        }

    }

    private function processData($videoData, $filePath)
    {
        $videoType = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!$this->isValidSize($videoData)) {
            echo 'File to large. Can\'t be more than ' . $this->sizeLimit . ' bytes';
            return false;
        } else if (!$this->isValidType($videoType)) {
            echo "Invalid file type";
            return false;
        } else if ($this->hasError($videoData)) {
            echo "Error code: " . $videoData['error'];
            return false;
        }
        return true;
    }

    private function isValidSize($data)
    {
        return $data['size'] <= $this->sizeLimit;
    }

    protected function isValidType($type)
    {
        $lowercased = strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data)
    {
        return $data['error'] != 0;
    }

    private function insertVideoData($uploadData, $filePath)
    {

        //debug($uploadData, 1);
        return DB::query('INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath, views, duration) 
                          VALUES (:title, :uploadedBy, :description, :privacy, :category, :filePath, 0, 0)',
                [
                        ':title' => $uploadData->title,
                        ':uploadedBy' => $uploadData->uploadedBy,
                        ':description' => $uploadData->description,
                        ':privacy' => $uploadData->privacy,
                        ':category' => $uploadData->category,
                        ':filePath' => $filePath
                ]);
    }

    public function convertVideoToMp4($tempFilePath, $finalFilePath)
    {
        $cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";

        $outputLog = [];
        exec($cmd, $outputLog, $returnCode);

        if ($returnCode != 0) {
            // Command failed
            foreach($outputLog as $line) {
                echo $line . '<br>';
            }

            return false;
        }

        return true;
    }

    private function deleteFile($filePath)
    {
        if (!unlink($filePath)) {
            echo 'Could not delete file\n';
            return false;
        }

        return true;
    }
}