<?php

interface StorageInterface
{
    public function initialize($config);
    public function saveGallery($data);
    public function saveImage($data);
    public function editGallery($gallery);
    public function editImage($image);
    public function getGalleries($order);
    public function getImages($id, $order);
    public function deleteGallery($gallery_id);
    public function deleteImage($image_id);
    public function getSingleEntry($name);
}