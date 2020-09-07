<?php

class Entry
{
    protected $id;
    protected $name;
    protected $title;
    protected $desc;
    protected $image;
    public function setID($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
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
    public function getName()
    {
        return $this->name;
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