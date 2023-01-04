<?php

namespace tstauras83;

class Output
{
    public function __construct(private array $output = [])
    {
    }

    public function store(mixed $data): void
    {
        $this->output[] = $data;
    }

    public function print(): void
    {
        foreach ($this->output as $line) {
            echo $line;
        }
    }
}