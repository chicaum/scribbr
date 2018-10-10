<?php

namespace App\Integration;

class ParserFactory
{
    private const CSV_TYPE = 'csv';
    private const JSON_TYPE = 'json';
    private const XML_TYPE = 'xml';

    public function factory(string $type): Parser
    {
        switch ($type) {
            case self::CSV_TYPE:
                return new CsvParser();
                break;
            case self::JSON_TYPE:
                return new JsonParser();
                break;
            case self::XML_TYPE:
                return new XmlParser();
                break;
        }

        throw new \InvalidArgumentException('Unknown type given');
    }
}
