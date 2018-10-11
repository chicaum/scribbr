<?php

namespace App\Tests\Service;

use App\Service\DateTimeUtility;
use PHPUnit\Framework\TestCase;

class DateTimeUtilityTest extends TestCase
{
    private $dateTimeUtility;

    public function setUp(){
        $this->dateTimeUtility = new DateTimeUtility(
            \DateTime::createFromFormat('Y-m-d', '2018-10-10')
        );
    }

    /**
     * @dataProvider datesProvider
     * @expectedException \Exception
     */
    public function testValidateInvalidDates($date)
    {
       $this->dateTimeUtility->validate($date);
    }

    public function datesProvider()
    {
        return [
            [ 'past date' => '2018-10-09' ],
            [ 'future date' => '2018-10-21' ],
            [ 'super future date' => '2018-11-21' ],
        ];
    }

    /**
     * @dataProvider validDatesProvider
     */
    public function testValidateValidDates($date)
    {
       static::assertTrue($this->dateTimeUtility->validate($date));
    }

    public function validDatesProvider()
    {
        return [
            [ 'same date' => '2018-10-10' ],
            [ 'date +1' => '2018-10-11' ],
            [ 'date +2' => '2018-10-12' ],
            [ 'date +3' => '2018-10-13' ],
            [ 'date +4' => '2018-10-14' ],
            [ 'date +5' => '2018-10-15' ],
            [ 'date +6' => '2018-10-16' ],
            [ 'date +7' => '2018-10-17' ],
            [ 'date +8' => '2018-10-18' ],
            [ 'date +9' => '2018-10-19' ],
            [ 'date +10' => '2018-10-20' ],
        ];
    }
}
