<?php

namespace Facilitador\Traits;

trait Seedable
{
    public function seed($class)
    {
        if (!class_exists($class)) {
            include_once $this->seedersPath.$class.'.php';
        }

        with(new $class())->run();
    }
}
