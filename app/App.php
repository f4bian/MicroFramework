<?php

namespace App;

/**
 * Class App
 * Main class of the framework. Needs to be created first.
 * @package App
 */
class App
{
    protected $container;
    
    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }


}