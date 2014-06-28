<?php namespace Laravel\Storage;

class FilesystemStorage implements StorageInterface {

    public function put($src, $dst)
    {
        return false;
    }

    public function getURL($path)
    {
        return null;
    }

    public function delete($path)
    {
        return false;
    }
}