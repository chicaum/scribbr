<?php

namespace App\Integration\Hydrator;

use App\Entity\Provider;

class XmlHydrator implements HydratorInterface
{
    public function hydrate($contents): Provider
    {
        // TODO: Implement hydrate() method.
        return new Provider();
    }
}
