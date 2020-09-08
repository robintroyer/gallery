<?php

interface StorageInterface
{
    public function initialize($config);
    // public function saveEntry($data);
    public function saveGallery($data);
    public function saveImage($data);
    // public function editEntry($entry);
    public function editGallery($gallery);
    public function editImage($image);
    public function getGalleries();
    public function getImages($id);
    // public function deleteEntry($id);
    public function deleteGallery($gallery_id);
    public function deleteImage($image_id);
    public function getSingleEntry($name);
}