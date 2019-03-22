<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class BeerId
{
    private $uuid;

    public static function fromString(string $todoId): BeerId
    {
        return new self(Uuid::fromString($todoId));
    }

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }
}