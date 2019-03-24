<?php

declare(strict_types=1);

namespace App\ProophessorDo\Model;

interface Entity
{
    public function sameIdentityAs(Entity $other): bool;
}
