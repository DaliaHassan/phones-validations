<?php

namespace App\Service;

use App\Service\Contract\PhoneDataServiceInterface;

class PhoneDataService implements PhoneDataServiceInterface
{
    /**
     * @var array
     */
    private $countriesValidators;

    /**
     * @param array $countriesValidators
     */
    public function __construct(array $countriesValidators)
    {
        $this->countriesValidators = $countriesValidators;
    }

    /**
     * Get Country Name.
     *
     * @param string $phone
     * @return string
     */
    public function getCountryName(string $phone): string
    {
        foreach ($this->countriesValidators as $key => $validator)
        {
            $pattern = '/' . substr($validator['regex'], 0, 10) . '/';
            preg_match($pattern, $phone, $matches);
            if (count($matches) > 0) {
                return $key;
            }
        }
    }

    /**
     * Get Country Code.
     *
     * @param string $phone
     * @return string
     */
    public function getCountryCode(string $phone): string
    {
        foreach ($this->countriesValidators as $validator)
        {
            $pattern = '/' . substr($validator['regex'], 0, 10) . '/';
            preg_match($pattern, $phone,$matches);

            if (count($matches) > 0) {
                return $validator['countryCode'];
            }
        }
    }

    /**
     * Get State.
     *
     * @param string $phone
     * @return string
     */
    public function getState(string $phone): string
    {
            $state = "false";
        foreach ($this->countriesValidators as $validator)
        {
            $pattern = '/' . $validator['regex'] . '/';
            preg_match($pattern, $phone, $matches);
            if (count($matches) > 0) {
                $state = "true";
            }
        }
        return $state;
    }
}