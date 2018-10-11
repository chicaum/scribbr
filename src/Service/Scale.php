<?php

namespace App\Service;

class Scale
{
    private static $scales = [
        'celsius' => 'celsius',
        'fahrenheit' => 'fahrenheit',
        'reaumur' => 'reaumur',
        'newton' => 'newton',
        'romer' => 'romer',
    ];

    private $scale;

    private $value;

    public function __construct(string $scale, int $value)
    {
        $this->scale = $scale;
        $this->value = $value;
    }

    public function getValue($desiredScale)
    {
        if($desiredScale === $this->scale) {
            return $this->value;
        }

        return $this->convert($desiredScale);
    }

    public function convert(string $desiredScale)
    {
        if (!in_array($desiredScale, self::$scales)) {
           throw new \Exception('Unknow Scale ' . $desiredScale, 400);
        }

        if ($this->scale === self::$scales['celsius']) {
            switch ($desiredScale) {
                case self::$scales['fahrenheit']:
                    $number = ($this->value * 1.8) + 32;
                    break;
                case self::$scales['reaumur']:
                    #Todo implement celsius to reaumur conversion
                    break;
                case self::$scales['newton']:
                    #Todo implement celsius to newton conversion
                    break;
                case self::$scales['romer']:
                    #Todo implement celsius to romer conversion
                    break;
            }
        }

        if ($this->scale === self::$scales['fahrenheit']) {
            switch ($desiredScale) {
                case self::$scales['celsius']:
                    $number = ($this->value - 32 ) / 1.8;
                    break;
                case self::$scales['reaumur']:
                    #Todo implement fahrenheit to reaumur conversion
                    break;
                case self::$scales['newton']:
                    #Todo implement fahrenheit to newton conversion
                    break;
                case self::$scales['romer']:
                    #Todo implement fahrenheit to romer conversion
                    break;
            }
        }

        return number_format($number, 2, ',', ' ');
    }
}