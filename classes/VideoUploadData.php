<?php


class VideoUploadData
{
    public $videoDataArray;
    public $title;
    public $description;
    public $privacy;
    public $category;
    public $upladedBy;

    public function __construct(
            $videoDataArray,
            $title,
            $description,
            $privacy,
            $category,
            $upladedBy)
    {
        $this->videoDataArray = $videoDataArray;
        $this->title = $title;
        $this->description = $description;
        $this->privacy = $privacy;
        $this->category = $category;
        $this->upladedBy = $upladedBy;

    }

    /*public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }*/
}