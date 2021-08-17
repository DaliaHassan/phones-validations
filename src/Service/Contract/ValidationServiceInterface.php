<?php

namespace App\Service\Contract;

interface ValidationServiceInterface
{
    /**
     * Validate Data.
     *
     * @param array $data
     * @return array
     */
    public function validate(array $data): array;
}