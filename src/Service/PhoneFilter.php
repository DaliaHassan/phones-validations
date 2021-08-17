<?php

namespace App\Service;

class PhoneFilter extends BaseFilter
{
    /**
     * Apply filters.
     *
     * @param array $data
     * @param array $requestedFilters
     *
     * @return array
     */
    public function applyFilter(array $data, array $requestedFilters): array
    {
        foreach($requestedFilters as $key => $filter)
        {
            if (!empty($filter)) {
                $data = array_filter($data, function($v) use ($key, $filter) {
                    return $v[$key] == $filter;
                }, ARRAY_FILTER_USE_BOTH);
            }
        }
        return $data;
    }
}