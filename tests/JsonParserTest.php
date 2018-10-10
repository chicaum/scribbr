<?php

namespace App\Tests;

use App\Integration\JsonParser;
use PHPUnit\Framework\TestCase;

class JsonParserTest extends TestCase
{
    public function testParse()
    {
        $json = $this->getJson();
        $parser = new JsonParser(true);
        $parsed = $parser->parse($json);

        static::assertInstanceOf(\stdClass::class, $parsed);
        static::assertEquals('Fahrenheit', $parsed->predictions->{'-scale'});
        static::assertEquals('Amsterdam', $parsed->predictions->{'city'});
        static::assertEquals('20180112', $parsed->predictions->{'date'});
        static::assertCount(11, $parsed->predictions->prediction);
    }

    private function getJson()
    {
        $json = <<<JSON
{
  "predictions": {
    "-scale": "Fahrenheit",
    "city": "Amsterdam",
    "date": "20180112",
    "prediction": [
      {
        "time": "00:00",
        "value": "31"
      },
      {
        "time": "01:00",
        "value": "32"
      },
      {
        "time": "02:00",
        "value": "25"
      },
      {
        "time": "03:00",
        "value": "26"
      },
      {
        "time": "04:00",
        "value": "20"
      },
      {
        "time": "05:00",
        "value": "22"
      },
      {
        "time": "06:00",
        "value": "23"
      },
      {
        "time": "07:00",
        "value": "22"
      },
      {
        "time": "08:00",
        "value": "25"
      },
      {
        "time": "09:00",
        "value": "24"
      },
      {
        "time": "10:00",
        "value": "24"
      }
    ]
  }
}
JSON;

        return $json;
    }
}
