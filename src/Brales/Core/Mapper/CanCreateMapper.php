<?php

namespace Brales\Core\Mapper;

interface CanCreateMapper
{
    public function create(string $className);
}