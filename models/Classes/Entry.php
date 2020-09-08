<?php
class Entry
{
    protected $id;
    protected $name;
    protected $desc;
    public function setID($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }
    public function getID()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDesc()
    {
        return $this->desc;
    }
}