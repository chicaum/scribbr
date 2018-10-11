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
                'scale' => new Scale('celsius', 25),
                'desired scale' => 'fahrenheit',
                'expected fahrenheit' => '77,00'
            ],
            [
                'scale' => new Scale('celsius', 30),
                'desired scale' => 'fahrenheit',
                'expected fahrenheit' => '86,00'
            ],
            [
                'scale' => new Scale('fahrenheit', 6),
                'desired scale' => 'celsius',
                'expected celsius' => '-14,44'
            ],
            [
                'scale' => new Scale('fahrenheit', 59),
                'desired scale' => 'celsius',
                'expected celsius' => '15,00'
            ],
        ];
    }
}
