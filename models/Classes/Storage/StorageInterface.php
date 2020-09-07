<?php

interface StorageInterface
{
    public function initialize($config);
    public function saveEntry($data);
    public function editEntry($entry);
    public function getEntries();
    public function deleteEntry($id);
}