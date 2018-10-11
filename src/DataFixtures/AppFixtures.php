<?php

namespace App\DataFixtures;

use App\Entity\Prediction;
use App\Entity\Provider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cities = [
            'Amsterdam',
            'Rotterdam',
            'Haarlem',
            'Groningen',
        ];

        $partnersData = [
            [
                'name' => 'BBC',
                'type' => 'csv',
                'scale' => 'celsius'
            ],
            [
                'name' => 'Weather.com',
                'type' => 'json',
                'scale' => 'fahrenheit'
            ],
            [
                'name' => 'AccuWeather',
                'type' => 'xml',
                'scale' => 'celsius'
            ],
        ];

        foreach ($partnersData as $partner) {
            $provider = new Provider();
            $provider->setName($partner['name']);
            $provider->setType($partner['type']);
            $expires = \DateTimeImmutable::createFromMutable(
                new \DateTime('+ 1 minute')
            );

            foreach ($cities as $city) {
                $date = new \DateTime(\date('Ymd'));
                for ($j = 0; $j < 10; $j++) {
                    for ($i = 0; $i < 24; $i++) {
                        $time = $i < 10 ? "0$i:00" : "$i:00";
                        $prediction = new Prediction();
                        $prediction->setProvider($provider);
                        $prediction->setScale($partner['scale']);
                        $prediction->setCity($city);
                        $prediction->setDate(
                            \DateTimeImmutable::createFromFormat(
                                'Ymd', $date->format('Ymd')
                            )
                        );
                        $prediction->setTime(
                            \DateTimeImmutable::createFromFormat('H:i', $time)
                        );
                        $prediction->setValue(\random_int(-20, 50));
                        $prediction->setExpires($expires);
                        $provider->addPrediction($prediction);
                    }
                    $date->add(new \DateInterval('P1D'));
                }
            }

            $manager->persist($provider);
            $manager->flush();
        }
    }
}
