<?php

namespace App\Repository;

use App\Aggregate\Beer;
use App\Aggregate\UserBeer;
use App\Entity\BeerId;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Ramsey\Uuid\UuidInterface;

class BeerRepository extends AggregateRepository implements BeerCollection
{
    public function save(Beer $beer): void
    {
        $this->saveAggregateRoot($beer);
    }

    public function getBeer(BeerId $beerId): Beer
    {
        return $this->getAggregateRoot((string)$beerId);
    }
}
