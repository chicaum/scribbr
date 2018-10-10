<?php

namespace App\Tests;

use App\Integration\CsvParser;
use PHPUnit\Framework\TestCase;

class CsvParserTest extends TestCase
{
    public function testParseWithoutHeaderLine()
    {
        $csv = $this->getCSV();
        $parser = new CsvParser(true);
        $parsed = $parser->parse($csv);

        $this->assertCount(11, $parsed);
        $this->assertArraySubset(
            [['celsius', 'Amsterdam', '20180112', '00:00', '05']],
            $parsed
        );
    }

    public function testParseWithHeaderLine()
    {
        $csv = $this->getCSV();
        $parser = new CsvParser(false);
        $parsed = $parser->parse($csv);

        $this->assertCount(12, $parsed);
        $this->assertArraySubset(
            [['-scale', 'city', 'date', 'prediction__time', 'prediction__value']],
            $parsed
        );
    }

    private function getCSV()
    {
        $csv = <<<CSV
"-scale","city","date","prediction__time","prediction__value"
"celsius","Amsterdam","20180112","00:00","05"
"","","","01:00","05"
"","","","02:00","06"
"","","","03:00","05"
"","","","04:00","08"
"","","","05:00","05"
"","","","06:00","15"
"","","","07:00","00"
"","","","08:00","01"
"","","","09:00","02"
"","","","10:00","03"
CSV;
        return $csv;
    }
}
