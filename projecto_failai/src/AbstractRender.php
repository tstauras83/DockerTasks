<?php

namespace tstauras83;

abstract class AbstractRender
{
   protected $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }
    public function render()
    {
        $this->output->store($this->getContent());
    }
    abstract protected function getContent();

}