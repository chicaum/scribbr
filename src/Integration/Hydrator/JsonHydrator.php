<?php

namespace App\Integration\Hydrator;

use App\Entity\Prediction;

class JsonHydrator implements HydratorInterface
{
    public function hydrate($provider, $parsedContent)
    {
        $scale = strtolower($parsedContent->predictions->{'-scale'});
        $city = $parsedContent->predictions->{'city'};
        $date = \DateTimeImmutable::createFromFormat('Ymd', $parsedContent->predictions->{'date'});
        $expires = \DateTimeImmutable::createFromMutable(new \DateTime('+ 1 minute'));

        foreach ($parsedContent->predictions->prediction as $content) {
            $prediction = new Prediction();
            $prediction->setScale($scale);
            $prediction->setCity($city);
            $prediction->setDate($date);
            $time = \DateTimeImmutable::createFromFormat('H:i', $content->{'time'});
            $prediction->setTime($time);
            $value = (int) $content->{'value'};
            $prediction->setValue($value);
            $prediction->setExpires($expires);
            $provider->addPrediction($prediction);
        }
    }
}
