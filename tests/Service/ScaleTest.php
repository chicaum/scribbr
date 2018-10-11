<?php

namespace App\Tests\Service;

use App\Service\Scale;
use PHPUnit\Framework\TestCase;

class ScaleTest extends TestCase
{
    /**
     * @dataProvider scaleProvider
     */
    public function testConvert(Scale $scale, $desiredScale, $expected)
    {
        $converted = $scale->convert($desiredScale);

        static::assertEquals($expected, $converted);
    }

    public function scaleProvider()
    {
        return [
            [
                'scale' => new Scale('Celsius', 25),
                'desired scale' => 'Fahrenheit',
                'expected fahrenheit' => '77,00'
            ],
            [
                'scale' => new Scale('Celsius', 30),
                'desired scale' => 'Fahrenheit',
                'expected fahrenheit' => '86,00'
            ],
            [
                'scale' => new Scale('Fahrenheit', 6),
                'desired scale' => 'Celsius',
                'expected celsius' => '-14,44'
            ],
            [
                'scale' => new Scale('Fahrenheit', 59),
                'desired scale' => 'Celsius',
                'expected celsius' => '15,00'
            ],
        ];
    }
}
