<?php

namespace App\Repository;

use App\Aggregate\Beer;
use App\Entity\BeerId;

interface BeerCollection
{
    public function save(Beer $beer);

    public function getBeer(BeerId $beerId): Beer;
}
