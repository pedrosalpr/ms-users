<?php

declare(strict_types=1);

namespace App\Entities;

class UserType
{
    private const COMMON = 1;
    private const SHOPKEEPER = 2;

    private $type;

    private function __construct(int $type)
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return (string) $this->type;
    }

    public static function types(): array
    {
        return [
            static::COMMON,
            static::SHOPKEEPER,
        ];
    }

    public static function common(): self
    {
        return new self(static::COMMON);
    }

    public static function shopkeeper(): self
    {
        return new self(static::SHOPKEEPER);
    }
}
