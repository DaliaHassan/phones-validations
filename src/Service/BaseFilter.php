<?php

namespace App\Service;

abstract class BaseFilter
{
    /**
     * Apply filters.
     *
     * @param array $data
     * @param array $filters
     *
     * @return array
     */
    abstract protected function applyFilter(array $data, array $filters): array;
}