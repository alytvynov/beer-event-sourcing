<?php

namespace App\Repository;

use App\Aggregate\UserBeer;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Ramsey\Uuid\UuidInterface;

class UserBeerRepository extends AggregateRepository implements UserBeerRepositoryInterface
{
    public function save(UserBeer $userBeer): void
    {
        $this->saveAggregateRoot($userBeer);
    }

    public function get(UuidInterface $uuid): UserBeer
    {
        return $this->getAggregateRoot($uuid->toString());
    }
}
