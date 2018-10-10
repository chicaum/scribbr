<?php

namespace App\Integration\Hydrator;

use App\Entity\Provider;

interface HydratorInterface
{
    public function hydrate($provider, $parsedContent);
}
