<?php

namespace tstauras83;

class FS
{
    private string $fileContents;

    public function __construct(private string $fileName)
    {
        $this->fileContents = file_get_contents($this->fileName);
    }

    public function getFileContents(): string
    {
        return $this->fileContents;
    }
}