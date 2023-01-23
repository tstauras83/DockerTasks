<?php

namespace tstauras83\services;

class Container
{
    protected $bindings = [];
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {

    }
}