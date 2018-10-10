<?php

namespace App\Tests;

use App\Integration\Parser\XmlParser;
use PHPUnit\Framework\TestCase;

class XmlParserTest extends TestCase
{
    public function testParse()
    {
        $xml = $this->getXml();
        $parser = new XmlParser();
        $parsed = $parser->parse($xml);

        static::assertEquals('celsius', $parsed['scale']);
        static::assertEquals('Amsterdam', $parsed->city);
        static::assertEquals('20180112', $parsed->date);
        foreach ($parsed->prediction as $prediction) {
            static::assertObjectHasAttribute('time', $prediction);
            static::assertObjectHasAttribute('value', $prediction);
        }
    }

    private function getXml(): string
    {
        $xml = <<<XML
<?xml version="1.0" encoding="utf-8" ?>
<predictions scale="celsius">
    <city>Amsterdam</city>
    <date>20180112</date>
    <prediction>
        <time>00:00</time>
        <value>05</value>
    </prediction>
    <prediction>
        <time>01:00</time>
        <value>05</value>
    </prediction>
    <prediction>
        <time>02:00</time>
        <value>06</value>
    </prediction>
    <prediction>
        <time>03:00</time>
        <value>05</value>
    </prediction>
    <prediction>
        <time>04:00</time>
        <value>08</value>
    </prediction>
    <prediction>
        <time>05:00</time>
        <value>05</value>
    </prediction>
    <prediction>
        <time>06:00</time>
        <value>15</value>
    </prediction>
    <prediction>
        <time>07:00</time>
        <value>00</value>
    </prediction>
    <prediction>
        <time>08:00</time>
        <value>01</value>
    </prediction>
    <prediction>
        <time>09:00</time>
        <value>02</value>
    </prediction>
    <prediction>
        <time>10:00</time>
        <value>03</value>
    </prediction>
</predictions>
XML;

        return $xml;
    }
}
