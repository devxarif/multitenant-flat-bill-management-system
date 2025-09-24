<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case OWNER = 'owner';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Admin',
            self::OWNER => 'Owner',
        };
    }
}
