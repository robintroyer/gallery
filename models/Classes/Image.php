<?php
class Image
{
    protected $id;
    protected $gallery_id;
    protected $title;
    protected $desc;
    protected $image;
    public function setID($id)
    {
        $this->id = $id;
    }
    public function setGalleryID($gallery_id)
    {
        $this->gallery_id = $gallery_id;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getID()
    {
        return $this->id;
    }
    public function getGalleryID()
    {
        return $this->gallery_id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDesc()
    {
        return $this->desc;
    }
    public function getImage()
    {
        return $this->image;
    }
}