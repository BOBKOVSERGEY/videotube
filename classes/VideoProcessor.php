<?php


class VideoProcessor
{
    private $sizeLimit = 500000000; // 4.5gb

    public function upload($videoUploadData)
    {
        $targetDir = 'uploads/videos/';
        $videoData = $videoUploadData->videoDataArray;
        $tempFilePath = $targetDir . uniqid() . basename($videoData['name']);

        $tempFilePath = str_replace(' ', '_', $tempFilePath);
        $isValidData = $this->processData($videoData, $tempFilePath);

        echo $tempFilePath;
    }

    private function processData($videoData, $filePath)
    {
        $videoType = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!$this->isValidSize($videoData)) {
            echo 'File to large. Can\'t be more than ' . $this->sizeLimit . ' bytes';
            return false;
        }
    }

    private function isValidSize($data)
    {
        return $data['size'] <= $this->sizeLimit;
    }
}