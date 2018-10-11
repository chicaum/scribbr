<?php

namespace App\Integration\Hydrator;

use App\Entity\Prediction;
use App\Entity\Provider;

class XmlHydrator implements HydratorInterface
{
    public function hydrate($provider, $parsedContent)
    {
        $date = \DateTimeImmutable::createFromFormat('Ymd',$parsedContent->date);
        $expires = \DateTimeImmutable::createFromMutable(new \DateTime('+ 1 minute'));

        foreach ($parsedContent->prediction as $partnerPrediction) {
            $prediction = new Prediction();
            $prediction->setScale(strtolower($parsedContent['scale']));
            $prediction->setCity($parsedContent->city);
            $prediction->setDate($date);
            $time = \DateTimeImmutable::createFromFormat('H:i', $partnerPrediction->time);
            $prediction->setTime($time);
            $value = (int) $partnerPrediction->{'value'}->__toString();
            $prediction->setValue($value);
            $prediction->setExpires($expires);
            $provider->addPrediction($prediction);
        }
    }
}
