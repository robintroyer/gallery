<?php

interface StorageInterface
{
    public function initialize($config);
    // public function saveEntry($data);
    public function saveGallery($data);
    public function saveImage($data);
    public function editEntry($entry);
    public function getEntries();
    public function deleteEntry($id);
    public function getSingleEntry($name);
}