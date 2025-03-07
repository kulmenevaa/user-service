<?php declare(strict_types=1);

namespace App\Helpers;

class PhoneHelper
{
    /**
     * @param ?string $phone
     * @return string
     */
    public static function cleanup(?string $phone): string
    {
        if ($phone) {
            $phone = preg_replace('/^8/', '7', preg_replace('/\D+/', '', $phone));
            return strlen($phone) === 10 ? "7{$phone}" : $phone;
        }
        return '';
    }
}