<?php

declare(strict_types=1);

namespace App\ProophessorDo\Model;

interface ValueObject
{
    public function sameValueAs(ValueObject $object): bool;
}
