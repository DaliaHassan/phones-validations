<?php

namespace App\Service\Contract;

Interface PhoneDataServiceInterface
{
    /**
     * Get Country Name.
     *
     * @param string $phone
     * @return string
     *
     */
    public function getCountryName(string $phone): string;

    /**
     * Get Country Code.
     *
     * @param string $phone
     * @return string
     *
     */
    public function getCountryCode(string $phone): string;

    /**
     * Get state if valid or not.
     *
     * @param string $phone
     * @return string
     *
     */
    public function getState(string $phone): string;
}