<?php

namespace App\Constant;

final class Country
{
    const CAMEROON = 'Cameroon';
    const ETHIOPIA = 'Ethiopia';
    const MOROCCO = 'Morocco';
    const MOZAMBIQUE = 'Mozambique';
    const UGANDA = 'Uganda';

    const CAMEROON_COUNTRY_CODE   = '+237';
    const ETHIOPIA_COUNTRY_CODE = '+251';
    const MOROCCO_COUNTRY_CODE = '+212';
    const MOZAMBIQUE_COUNTRY_CODE = '+258';
    const UGANDA_COUNTRY_CODE    = '+256';

    const CAMEROON_REGEX   = '\(237\)\ ?[2368]\d{7,8}$';
    const ETHIOPIA_REGEX  = '\(251\)\ ?[1-59]\d{8}$';
    const MOROCCO_REGEX  = '\(212\)\ ?[5-9]\d{8}$';
    const MOZAMBIQUE_REGEX  = '\(258\)\ ?[28]\d{7,8}$';
    const UGANDA_REGEX     = '\(256\)\ ?\d{9}$';

    /**
     * Get Countries Names with country codes.
     *
     * @return array
     */
    public static function getCountriesNamesWithCodes()
    {
        return [
            self::CAMEROON_COUNTRY_CODE => self::CAMEROON,
            self::ETHIOPIA_COUNTRY_CODE => self::ETHIOPIA,
            self::MOROCCO_COUNTRY_CODE => self::MOROCCO,
            self::MOZAMBIQUE_COUNTRY_CODE => self::MOZAMBIQUE,
            self::UGANDA_COUNTRY_CODE => self::UGANDA
        ];
    }

    /**
     * Get Countries Data.
     *
     * @return array
     */
    public static function getCountriesData()
    {
        return [
            self::CAMEROON => [
                'countryCode' => self::CAMEROON_COUNTRY_CODE,
                'regex' => self::CAMEROON_REGEX
            ],
            self::ETHIOPIA => [
                'countryCode' => self::ETHIOPIA_COUNTRY_CODE,
                'regex' => self::ETHIOPIA_REGEX
            ],
            self::MOROCCO => [
                'countryCode' => self::MOROCCO_COUNTRY_CODE,
                'regex' => self::MOROCCO_REGEX
            ],
            self::MOZAMBIQUE => [
                'countryCode' => self::MOZAMBIQUE_COUNTRY_CODE,
                'regex' => self::MOZAMBIQUE_REGEX
            ],
            self::UGANDA => [
                'countryCode' => self::UGANDA_COUNTRY_CODE,
                'regex' => self::UGANDA_REGEX
            ],
        ];
    }
}
