<?php

namespace App\Enums;



enum LocationType: int
{
    case Country = 1;
    case Governorate = 2;
    case City = 3;

    /**
     * Get a label for each type (optional).
     */
    public function label(): string
    {
        return match ($this) {
            self::Country => 'Country',
            self::Governorate => 'Governorate',
            self::City => 'City',
        };
    }
}