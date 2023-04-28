<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AvatarGoogleDriveQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $filename;
    protected $url;

    public function __construct($path, $filename,$url)
    {
        $this->path = $path;
        $this->filename = $filename;
        $this->url = $url;

    }

    public function handle()
    {
        $path = Storage::disk('google')->putFileAs('/', $this->path, $this->filename);
        $this->url = Storage::disk('google')->url($path);
    }

    public function getUrl()
    {
        return $this->url;
    }
}
