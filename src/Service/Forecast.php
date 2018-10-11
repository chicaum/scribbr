<?php

namespace App\Service;

class Forecast
{
    public function consolidateData($predictions)
    {
        $consolidated = [];
        $expanded = [];

        foreach ($predictions as $prediction) {
            $time = $prediction->getTime()->format('H:i');
            $scale = new Scale($prediction->getScale(), $prediction->getValue());
            $celsius = $scale->getValue('celsius');
            $fahrenheit = $scale->getValue('fahrenheit');

            if (array_key_exists($time, $expanded)) {
                $expanded[$time]['values']['Celsius'][] = $celsius;
                $expanded[$time]['values']['Fahrenheit'][] = $fahrenheit;
            } else {
                $expanded[$time]['values']['Celsius'] = [$celsius];
                $expanded[$time]['values']['Fahrenheit'] = [$fahrenheit];
            }

            $consolidated[$time]['Celsius'] = $this->valuesAverage($expanded[$time]['values']['Celsius']);
            $consolidated[$time]['Fahrenheit'] = $this->valuesAverage($expanded[$time]['values']['Fahrenheit']);
        }

        return $consolidated;
    }

    private function valuesAverage(array $values)
    {
        if(\count($values) === 0) {
            return null;
        }

        $avg =array_sum($values) / \count($values);

        return number_format($avg, 2, ',', ' ');
    }
}