<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class SupplierFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $supplier = new Supplier();
            $supplier->setName(sprintf('supplier-%s', $i));
            $supplier->setUuid(Uuid::uuid1()->toString());

            $manager->persist($supplier);
        }

        $manager->flush();
    }
}
