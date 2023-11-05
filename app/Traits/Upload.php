<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait Upload
{
    public function UploadFile(UploadedFile $file, $directory = ".", $filename = null): bool|string
    {
        $FileName = !is_null($filename) ? $filename : Str::random(10);
        return $file->storeAs(
            "images/" . $directory,
            $FileName . "." . $file->getClientOriginalExtension(),
            "public",
        );
    }

    public function deleteFile($path, $disk = 'public'): void
    {
        Storage::disk($disk)->delete($path);
    }
}
