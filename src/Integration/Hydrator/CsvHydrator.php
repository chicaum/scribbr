<?php

namespace App\Integration\Hydrator;

use App\Entity\Provider;

class CsvHydrator implements HydratorInterface
{
    public function hydrate($contents): Provider
    {
        // TODO: Implement hydrate() method.
        return new Provider();
    }
}
