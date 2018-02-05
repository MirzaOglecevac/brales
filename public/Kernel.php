<?php

class Kernel
{

    protected $env;

    public function __construct($env = null)
    {
        if (is_null($env)) {
            $this->env = is_null($env) ? 'prod' : 'dev';
        }else{
            $this->env = $env;
        }
    }

    /**
     * Loads the container configuration.
     */
    public function registerContainerConfiguration()
    {
        if((string)$this->env === (string)'dev'){
            $configuration = 'config-development.yml';
        }else{
            $configuration = 'config-production.yml';
        }
        return $configuration;
    }

}