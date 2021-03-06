<?php

namespace Brales\Core\Component;

use Brales\Core\Mapper\CanCreateMapper;
use RuntimeException;
use PDO;

class MapperFactory implements CanCreateMapper
{
    private $connection;
    private $cache = [];
    private $configuration;

    /**
     * Creates new factory instance
     *
     * @param PDO $connection
     */
    public function __construct(PDO $connection, array $configuration)
    {
        $this->connection = $connection->connect($configuration);
        $this->configuration = $configuration;
    }

    /**
     * Method for retrieving an SQL data mapper instance
     *
     * @param string $className Fully qualified class name of the mapper
     * @throws RuntimeException if mapper's class can't be found
     */
    public function create(string $className) :DataMapper
    {
        if (array_key_exists($className, $this->cache)) {
            return $this->cache[$className];
        }
        if (!class_exists($className)) {
            throw new RuntimeException("Mapper not found. Attempted to load '{$className}'.");
        }
        //pass configuration as antoher argument
        $instance = new $className($this->connection, $this->configuration);
        $this->cache[$className] = $instance;
        return $instance;
    }
}