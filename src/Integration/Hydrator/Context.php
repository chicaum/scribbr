<?php

namespace App\Integration\Hydrator;

use App\Entity\Provider;

class Context
{
    private $hydrator;

    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function executeStrategy($contents): Provider
    {
        return $this->hydrator->hydrate($contents);
    }
}
