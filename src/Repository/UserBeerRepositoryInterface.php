<?php

namespace App\Repository;

use App\Aggregate\UserBeer;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Ramsey\Uuid\UuidInterface;

interface UserBeerRepositoryInterface
{
    public function save(UserBeer $userBeer): void;

    public function get(UuidInterface $uuid): UserBeer;
}