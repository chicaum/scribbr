<?php

namespace App\Integration\Hydrator;

use App\Entity\Prediction;
use App\Entity\Provider;

class CsvHydrator implements HydratorInterface
{
    public function hydrate($provider, $parsedContent)
    {
        $scale = $parsedContent[0][0];
        $city = $parsedContent[0][1];
        $date = \DateTimeImmutable::createFromFormat('Ymd', $parsedContent[0][2]);
        $expires = \DateTimeImmutable::createFromMutable(new \DateTime('+ 1 minute'));

        foreach ($parsedContent as $content) {
            $prediction = new Prediction();
            $prediction->setScale($scale);
            $prediction->setCity($city);
            $prediction->setDate($date);
            $time = \DateTimeImmutable::createFromFormat('H:i', $content[3]);
            $prediction->setTime($time);
            $value = (int) $content[4];
            $prediction->setValue($value);
            $prediction->setExpires($expires);
            $provider->addPrediction($prediction);
        }
    }
}
