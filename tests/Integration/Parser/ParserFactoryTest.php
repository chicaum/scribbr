<?php

namespace App\Tests\Integration\Parser;

use App\Integration\Parser\CsvParser;
use App\Integration\Parser\JsonParser;
use App\Integration\Parser\ParserFactory;
use App\Integration\Parser\XmlParser;
use PHPUnit\Framework\TestCase;

class ParserFactoryTest extends TestCase
{
    private $parserFactory;

    public function setUp()
    {
        $this->parserFactory = new ParserFactory();
    }

    /**
     * @dataProvider filesTypeProvider
     */
    public function testFactory($type, $expected)
    {
        $parser = $this->parserFactory->factory($type);

        $this->assertInstanceOf($expected, $parser);
    }

    public function filesTypeProvider()
    {
        return [
            [
                'type' => 'csv',
                'expected' => CsvParser::class,
            ],
            [
                'type' => 'json',
                'expected' => JsonParser::class,
            ],
            [
                'type' => 'xml',
                'expected' => XmlParser::class,
            ],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidFilesTypeProvider
     */
    public function testInvalidType($invalidType)
    {
        $this->parserFactory->factory($invalidType);
    }

    public function invalidFilesTypeProvider()
    {
        return [
            [ 'invalid type' => ''],
            [ 'invalid type' => 'something'],
            [ 'invalid type' => false],
            [ 'invalid type' => 123],
        ];
    }
}
