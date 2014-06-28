<?php namespace Laravel\Storage;

use Illuminate\Filesystem\Filesystem;

class FilesystemStorage implements StorageInterface {

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The upload directory
     */
    protected $upload_dir;

    /**
     * The upload root url
     */
    protected $upload_root_url;

    /**
     * Create a new filesystem storage instance
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  String $upload_dir
     * @param  String $upload_root_url
     */
    public function __construct(Filesystem $files, $upload_dir, $upload_root_url)
    {
        $this->files = $files;
        $this->upload_dir = $upload_dir;
        $this->upload_root_url = $upload_root_url;
    }

    public function put($src, $dst)
    {
        $path = implode(array($this->upload_dir, $dst), DIRECTORY_SEPARATOR);
        $pathinfo = pathinfo($path);
        $dirname = $pathinfo['dirname'];

        // check if dirname exists
        if(!$this->files->exists($dirname))
            // make sure dir exists
            $this->files->makeDirectory($dirname, 0755, true);

        return $this->files->copy($src, $path);
    }

    public function url($path)
    {
        return url(implode(array($this->upload_root_url, $path), "/"));
    }

    public function delete($path)
    {
        return $this->files->delete($path);
    }
}