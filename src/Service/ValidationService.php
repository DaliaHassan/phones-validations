<?php

namespace App\Service;

use App\Service\Contract\PhoneDataServiceInterface;
use App\Service\Contract\ValidationServiceInterface;

class ValidationService implements ValidationServiceInterface
{
    /**
     * @var PhoneDataServiceInterface
     */
    private $phoneDataService;

    /**
     * @param PhoneDataServiceInterface $phoneDataService
     */
    public function __construct(PhoneDataServiceInterface $phoneDataService)
    {
        $this->phoneDataService = $phoneDataService;
    }

    /**
     * Validate Data
     *
     * @param array $customersData
     * @return array
     */
    public function validate(array $customersData): array
    {
        $validatedData = [];
        foreach ($customersData as $key => $customerData)
        {
            $phone = $customerData['phone'];
            $phoneData = explode(' ', $phone);

            $validatedData[$key]['countryName'] = $this->phoneDataService->getCountryName($phone);
            $validatedData[$key]['state'] = $this->phoneDataService->getState($phone);
            $validatedData[$key]['countryCode'] =$this->phoneDataService->getCountryCode($phone);
            $validatedData[$key]['phoneNumber'] = end($phoneData);
        }
        return $validatedData;
    }
}